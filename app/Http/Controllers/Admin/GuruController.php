<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Imports\GuruImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\GuruModel;
use App\Mail\SendMailGuru;
use Illuminate\Support\Facades\Mail;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }
    public function index(){
        $menu = 'master';
        $submenu= 'guru';
        return view ('Admin/guru/data_guru',compact('menu','submenu'));
    }
    public function AjaxData(Request $request) {
            $Dataguru = guruModel::whereNull('deleted_at')->get();
        
        if ($Dataguru == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $Dataguru]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function editData($id)
    {
        $Dataguru = guruModel::where('nik_guru',$id)->first();
        if ($Dataguru == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $Dataguru]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function storeData(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'nik_guru' => 'required|numeric|digits_between:5,15|unique:guru,nik_guru',
                'nama_guru' => 'required|string|max:255',
                'tanggal_lahir_guru' => 'required|date',
                'tempat_lahir_guru' => 'required|string|max:255',
                'jenis_kelamin_guru' => 'required|in:L,P',
                'no_hp_guru' => 'required|numeric|digits_between:10,15',
                'email_guru' => 'required|email|max:255|unique:guru,email_guru,NULL,id',
                'foto_guru' => 'required|file|mimes:jpeg,png,jpg|max:2048'
            ]);
            
    
            // Generate unique ID based on current date and count
            $tanggal = now()->format('dmy');
            $nomorUrut = guruModel::whereDate('created_at', now()->toDateString())->count() + 1;
            $id = 'GR' . '-' . $tanggal . '-' . $nomorUrut;
    
            if ($request->hasFile('foto_guru')) {
                $file = $request->file('foto_guru');
                $nama_guru = $request->nama_guru;
                // Dapatkan nama asli file
                $originalFileName = $file->getClientOriginalName();
                // Buat nama file kustom
                $customFileName = $nama_guru . '-' . $originalFileName;
                // Simpan file dengan nama kustom
                $path = $file->storeAs('public/guru', $customFileName);
            }

            // Prepare data for insertion
            $date = new \DateTime($validatedData['tanggal_lahir_guru']);
            $formatTanggal = $date->format('dmY');
            $data = [
                'id_guru' => $id,
                'nik_guru' => $validatedData['nik_guru'],
                'nama_guru' => $validatedData['nama_guru'],
                'tanggal_lahir_guru' => $validatedData['tanggal_lahir_guru'],
                'tempat_lahir_guru' => $validatedData['tempat_lahir_guru'],
                'jenis_kelamin_guru' => $validatedData['jenis_kelamin_guru'],
                'no_hp_guru' => $validatedData['no_hp_guru'],
                'email_guru' => $validatedData['email_guru'],
                'foto_guru' => 'guru/' . $customFileName,
                'status_guru' => '0',
                'password' =>  Hash::make($formatTanggal),
                'id_user' => session('user')['id'],
            ];

    
            // Store data into database
            $guru = guruModel::create($data);
    
            // Check if data was successfully stored
            if ($guru) {
                // send email
                $PesanEmail = [
                    'nik_guru' => $validatedData['nik_guru'],
                    'nama_guru' => $validatedData['nama_guru'],
                    'tanggal_lahir_guru' => $validatedData['tanggal_lahir_guru'],
                    'tempat_lahir_guru' => $validatedData['tempat_lahir_guru'],
                    'jenis_kelamin_guru' => $validatedData['jenis_kelamin_guru'],
                    'no_hp_guru' => $validatedData['no_hp_guru'],
                    'email_guru' => $validatedData['email_guru'],
                    'password' =>  $formatTanggal,
                    'tanggal_daftar' => $tanggal,
                ];
                Mail::to($validatedData['email_guru'])->send(new SendMailGuru($PesanEmail));

                return response()->json(['success' => true, 'message' => 'Berhasil Tambah Data', 'data' => $guru]);
            } else {
                return response()->json(['error' => true, 'message' => 'Gagal Tambah Data']);
            }
    
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during validation or data insertion
            return response()->json(['error' => true, 'message' => $e->getMessage()],500);
        }
    }

    public function updateData($id, Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'nik_guru' => 'required|numeric|digits_between:5,15',
                'nama_guru' => 'required|string|max:255',
                'tanggal_lahir_guru' => 'required|date',
                'tempat_lahir_guru' => 'required|string|max:255',
                'jenis_kelamin_guru' => 'required|in:L,P',
                'no_hp_guru' => 'required|numeric|digits_between:10,15',
                'email_guru' => 'required|email|max:255',
                'foto_guru' => 'nullable|file|mimes:jpeg,png,jpg|max:2048'
            ]);
    
            // Cek apakah data guru ada
            $guruCek = guruModel::where('id_guru', $id)->first();
            if (!$guruCek) {
                return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
            }
    
            $data = $validatedData;
    
            // Proses upload foto
            if ($request->hasFile('foto_guru')) {
                // Hapus gambar lama jika ada
                if ($guruCek->foto_guru) {
                    Storage::delete('public/' . $guruCek->foto_guru);
                }
    
                // Simpan gambar baru
                $file = $request->file('foto_guru');
                $nama_guru = $request->nama_guru;
    
                // Buat nama file kustom menggunakan timestamp
                $customFileName = $nama_guru . '-' . time() . '.' . $file->extension();
    
                // Simpan file dengan nama kustom
                $path = $file->storeAs('public/guru', $customFileName);
                $data['foto_guru'] = 'guru/' . $customFileName;
            }
    
            // Format tanggal untuk password
            $date = new \DateTime($validatedData['tanggal_lahir_guru']);
            $formatTanggal = $date->format('dmY');
    
            // Tambahkan password ke data hanya jika password diperlukan untuk diperbarui
            $data['password'] = Hash::make($formatTanggal);
    
            // Update data guru di database
            $updateResult = guruModel::where('id_guru', $id)->update($data);
    
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
            $guru = guruModel::where('nik_guru',$id);

            $data = [
                'status_guru' => 3,
                'deleted_at' => now()->format('Y-m-d h:i:s')
            ];

            $guru->update($data);

            return response()->json(['success' => true, 'message' => 'Berhasil Hapus Data']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Gagal Hapus Data: ' . $e->getMessage()]);
        }
    }

    public function statusData($id, $status)
    {
        try {
            $guru = guruModel::where('nik_guru',$id); // Cari guru berdasarkan ID

            $guru->update(['status_guru' => $status]); // Update status periode guru

            if ($status == 1) {
                return response()->json(['success' => true, 'message' => 'Berhasil mengaktifkan data guru.']);
            } else {
                return response()->json(['success' => true, 'message' => 'Berhasil menonaktifkan data guru.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Gagal: ' . $e->getMessage()]); // Tangani jika terjadi kesalahan dalam pencarian atau pembaruan
        }
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file_guru' => 'required|mimes:xls,xlsx|max:2048', // max 2MB
        ]);
    
        $file = $request->file('file_guru');
    
        try {
            Excel::import(new guruImport, $file);
    
            return response()->json(['success' => true, 'message' => 'Berhasil Import Data']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }  

    public function setingData(Request $request) {
        try {
            $validatedData = $request->validate([
                'status_guru' => 'required|string|max:255'
            ]);
            $Dataguru = guruModel::whereNull('deleted_at')->get();

            if ($Dataguru == true) {
                foreach ($Dataguru as $key => $value) {
                    guruModel::where('id_guru',$value->id_guru)->update([
                        'status_guru' => $validatedData['status_guru']
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

    public function SendEmail($id)
    {
        try {
            $guru = guruModel::where('nik_guru',$id)->first();
            $date = new \DateTime($guru->tanggal_lahir_guru);
            $formatTanggal = $date->format('dmY');
            $PesanEmail = [
                'nik_guru' => $guru->nik_guru,
                'nama_guru' => $guru->nama_guru,
                'tanggal_lahir_guru' => $guru->tanggal_lahir_guru,
                'tempat_lahir_guru' => $guru->tempat_lahir_guru,
                'jenis_kelamin_guru' => $guru->jenis_kelamin_guru,
                'no_hp_guru' => $guru->no_hp_guru,
                'email_guru' => $guru->email_guru,
                'password' =>  $formatTanggal,
                'tanggal_daftar' => $guru->created_at,
            ];
            Mail::to($guru->email_guru)->send(new SendMailGuru($PesanEmail));

            return response()->json(['success' => true, 'message' => 'Berhasil Kirim Data']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Gagal Kirim Data: ' . $e->getMessage()]);
        }
    }

    public function ResetPassword($id){
        try {
            $guru = guruModel::where('nik_guru',$id)->first();
            if ($guru) {
                $date = new \DateTime($guru->tanggal_lahir_guru);
                $formatTanggal = $date->format('dmY');
                $data = [
                    'password' =>  Hash::make($formatTanggal),
                ];

                $PesanEmail = [
                    'nik_guru' => $guru->nik_guru,
                    'nama_guru' => $guru->nama_guru,
                    'tanggal_lahir_guru' => $guru->tanggal_lahir_guru,
                    'tempat_lahir_guru' => $guru->tempat_lahir_guru,
                    'jenis_kelamin_guru' => $guru->jenis_kelamin_guru,
                    'no_hp_guru' => $guru->no_hp_guru,
                    'email_guru' => $guru->email_guru,
                    'password' =>  $formatTanggal,
                    'tanggal_daftar' => $guru->created_at,
                ];
                Mail::to($guru->email_guru)->send(new SendMailGuru($PesanEmail));
                
                return response()->json(['success' => true, 'message' => 'Berhasil Reset Password']);
            } else {
                return response()->json(['success' => true, 'message' => 'Gagal Reset Password']);
            }
            
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Gagal Kirim Data: ' . $e->getMessage()]);
        }
    }
        
}
