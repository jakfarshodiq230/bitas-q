<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\SiswaModel;
use App\Mail\SendMailSiswa;
use Illuminate\Support\Facades\Mail;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }
    public function index(){
        $menu = 'master';
        $submenu= 'siswa';
        return view ('Admin/siswa/data_siswa',compact('menu','submenu'));
    }
    public function AjaxData(Request $request) {
            $DataSiswa = SiswaModel::whereNull('deleted_at')->get();
        
        if ($DataSiswa == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $DataSiswa]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function editData($id)
    {
        $DataSiswa = SiswaModel::where('nisn_siswa',$id)->first();
        if ($DataSiswa == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $DataSiswa]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function storeData(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'nisn_siswa' => 'required|numeric|digits:10|unique:siswa,nisn_siswa',
                'nama_siswa' => 'required|string|max:255',
                'tanggal_lahir_siswa' => 'required|date',
                'tempat_lahir_siswa' => 'required|string|max:255',
                'jenis_kelamin_siswa' => 'required|in:L,P',
                'no_hp_siswa' => 'required|numeric|digits_between:10,15',
                'email_siswa' => 'required|email|max:255|unique:siswa,email_siswa,NULL,id',
                'tahun_masuk_siswa' => 'required|numeric|digits:4|between:2000,' . date('Y'),
                'orangtua_siswa' => 'required|string|max:255',
                'foto_siswa' => 'required|file|mimes:jpg,jpeg|max:2048'
            ]);
                     

            // Generate unique ID based on current date and count
            $tanggal = now()->format('dmy');
            $nomorUrut = SiswaModel::whereDate('created_at', now()->toDateString())->count() + 1;
            $id = 'SW' . '-' . $tanggal . '-' . $nomorUrut;
    
            if ($request->hasFile('foto_siswa')) {
                $file = $request->file('foto_siswa');
                $nama_siswa = $request->nama_siswa;
                // Dapatkan nama asli file
                $originalFileName = $file->getClientOriginalName();
                // Buat nama file kustom
                $customFileName = $nama_siswa . '-' . $originalFileName;
                // Simpan file dengan nama kustom
                $path = $file->storeAs('public/siswa', $customFileName);
            }

            // Prepare data for insertion
            $date = new \DateTime($validatedData['tanggal_lahir_siswa']);
            $formatTanggal = $date->format('dmy');

            $data = [
                'id_siswa' => $id,
                'nisn_siswa' => $validatedData['nisn_siswa'],
                'nama_siswa' => $validatedData['nama_siswa'],
                'tanggal_lahir_siswa' => $validatedData['tanggal_lahir_siswa'],
                'tempat_lahir_siswa' => $validatedData['tempat_lahir_siswa'],
                'jenis_kelamin_siswa' => $validatedData['jenis_kelamin_siswa'],
                'no_hp_siswa' => $validatedData['no_hp_siswa'],
                'email_siswa' => $validatedData['email_siswa'],
                'tahun_masuk_siswa' => $validatedData['tahun_masuk_siswa'],
                'foto_siswa' => 'siswa/' . $customFileName,
                'status_siswa' => '0',
                'password' =>  Hash::make($formatTanggal),
                'id_user' => session('user')['id'],
            ];

    
            // Store data into database
            $siswa = SiswaModel::create($data);
    
            // Check if data was successfully stored
            if ($siswa) {
                return response()->json(['success' => true, 'message' => 'Berhasil Tambah Data', 'data' => $siswa]);
            } else {
                return response()->json(['error' => true, 'message' => 'Gagal Tambah Data']);
            }
    
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during validation or data insertion
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }      
    }

    public function updateData($id, Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'nisn_siswa' => 'required|numeric|digits:10',
                'nama_siswa' => 'required|string|max:255',
                'tanggal_lahir_siswa' => 'required|date',
                'tempat_lahir_siswa' => 'required|string|max:255',
                'jenis_kelamin_siswa' => 'required|in:L,P',
                'no_hp_siswa' => 'required|numeric|digits_between:10,15',
                'email_siswa' => 'required|email|max:255',
                'tahun_masuk_siswa' => 'required|numeric|digits:4|between:2000,' . date('Y'),
                'orangtua_siswa' => 'required|string|max:255',
                'foto_siswa' => 'nullable|file|mimes:jpeg,jpg|max:2048',
                
            ]);
    
            // Cek apakah data siswa ada
            $siswaCek = SiswaModel::where('id_siswa', $id)->first();
            if (!$siswaCek) {
                return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
            }
    
            // Proses upload foto
            if ($request->hasFile('foto_siswa')) {
                // Hapus gambar lama jika ada
                if ($siswaCek->foto_siswa) {
                    // Menggunakan Storage facade untuk menghapus file
                    Storage::delete('public/' . $siswaCek->foto_siswa);
                }
    
                // Simpan gambar baru
                $file = $request->file('foto_siswa');
                $nama_siswa = $request->nama_siswa;
    
                // Buat nama file kustom untuk menghindari bentrok
                $customFileName = $nama_siswa . '-' . time() . '.' . $file->extension();
    
                // Simpan file dengan nama kustom
                $path = $file->storeAs('public/siswa', $customFileName);
                $data['foto_siswa'] = 'siswa/' . $customFileName;
            }
    
            // Prepare data for update
            $data = array_merge($validatedData, $data ?? []);
    
            // Update data siswa di database
            $updateResult = SiswaModel::where('id_siswa', $id)->update($data);
    
            // Cek apakah update berhasil
            if ($updateResult) {
                return response()->json(['success' => true, 'message' => 'Berhasil Edit Data']);
            } else {
                return response()->json(['error' => true, 'message' => 'Gagal Edit Data']);
            }
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => true, 'message' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Tangani pengecualian yang terjadi selama proses
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }
    

    public function deleteData($id)
    {
        try {
            $siswa = SiswaModel::where('nisn_siswa',$id);

            $data = [
                'status_siswa' => 3,
                'deleted_at' => now()->format('Y-m-d h:i:s')
            ];

            $siswa->update($data);

            return response()->json(['success' => true, 'message' => 'Berhasil Hapus Data']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Gagal Hapus Data: ' . $e->getMessage()]);
        }
    }

    public function statusData($id, $status)
    {
        try {
            $siswa = SiswaModel::where('nisn_siswa',$id); // Cari siswa berdasarkan ID

            $siswa->update(['status_siswa' => $status]); // Update status periode siswa

            if ($status == 1) {
                return response()->json(['success' => true, 'message' => 'Berhasil mengaktifkan data siswa.']);
            } else {
                return response()->json(['success' => true, 'message' => 'Berhasil menonaktifkan data siswa.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Gagal: ' . $e->getMessage()]); // Tangani jika terjadi kesalahan dalam pencarian atau pembaruan
        }
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file_siswa' => 'required|mimes:xls,xlsx|max:2048', // max 2MB
        ]);
    
        $file = $request->file('file_siswa');
    
        try {
            Excel::import(new SiswaImport, $file);
    
            return response()->json(['success' => true, 'message' => 'Berhasil Import Data']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }  

    public function setingData(Request $request) {
        try {
            $validatedData = $request->validate([
                'tahun_masuk_siswa2' => 'required|numeric|digits:4|min:2000|max:' . date('Y'),
                'status_siswa' => 'required|string|max:255'
            ]);
            $DataSiswa = SiswaModel::where('tahun_masuk_siswa',$validatedData['tahun_masuk_siswa2'])->whereNull('deleted_at')->get();

            if ($DataSiswa == true) {
                foreach ($DataSiswa as $key => $value) {
                    SiswaModel::where('id_siswa',$value->id_siswa)->update([
                        'status_siswa' => $validatedData['status_siswa']
                    ]);
                }
                return response()->json(['success' => true, 'message' => 'Data Ditemukan']);
            }else{
                return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function ResetPassword($id){
        try {
            $siswa_cek = SiswaModel::where('nisn_siswa',$id)->first();
            if ($siswa_cek) {
                $date = new \DateTime($siswa_cek->tanggal_lahir_siswa);
                $formatTanggal = $date->format('dmY');
                $data = [
                    'password' =>  Hash::make($formatTanggal),
                ];

                $PesanEmail = [
                    'nisn_siswa' => $siswa_cek->nisn_siswa,
                    'nama_siswa' => $siswa_cek->nama_siswa,
                    'tanggal_lahir_siswa' => $siswa_cek->tanggal_lahir_siswa,
                    'tempat_lahir_siswa' => $siswa_cek->tempat_lahir_siswa,
                    'jenis_kelamin_siswa' => $siswa_cek->jenis_kelamin_siswa,
                    'no_hp_siswa' => $siswa_cek->no_hp_siswa,
                    'email_siswa' => $siswa_cek->email_siswa,
                    'password' =>  $formatTanggal,
                    'tanggal_daftar' => $siswa_cek->created_at,
                ];
                Mail::to($siswa_cek->email_siswa)->send(new SendMailSiswa($PesanEmail));
                
                return response()->json(['success' => true, 'message' => 'Berhasil Reset Password']);
            } else {
                return response()->json(['success' => true, 'message' => 'Gagal Reset Password']);
            }
            
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Gagal Kirim Data: ' . $th->getMessage()]);
        }
    }
        
}
