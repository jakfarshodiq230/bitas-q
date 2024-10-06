<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\TahunAjaranModel;
use App\Models\Admin\PeriodeModel;
use App\Models\Admin\PesertaPbiModel;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\GuruModel;
use App\Models\Admin\KelasModel;
class PesertaPbiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }
    public function index(){
        $menu = 'pbi';
        $submenu= 'peserta-pbi';
        return view ('Admin/pbi/peserta/data_peserta_pbi',compact('menu','submenu'));
    }

    public function AjaxDataPeriode(Request $request) {
        $DataPeserta = PesertaPbiModel::DataAllAdmin();
        if ($DataPeserta == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $DataPeserta]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function DataListPesertaPbi($id_periode,$id_tahun_ajaran){
        $menu = 'pbi';
        $submenu= 'peserta-pbi';
        $periode = $id_periode;
        $tahun_ajaran = $id_tahun_ajaran;
        $judul_1 = PeriodeModel::where('id_periode', $id_periode)->whereNull('deleted_at')->first();
        $judul_2 = TahunAjaranModel::where('id_tahun_ajaran', $id_tahun_ajaran)->whereNull('deleted_at')->first();
        $judul_3 = ucfirst($judul_1->jenis_periode).' '. $judul_2->nama_tahun_ajaran;
        $periode_lampau = PeriodeModel::DataPbi($id_periode);
        return view ('Admin/pbi/peserta/data_list_peserta_pbi',compact('menu','submenu','periode','tahun_ajaran','judul_1','judul_2','judul_3','periode_lampau'));
    }

    public function AjaxData($id_periode,$id_tahun_ajaran) {
        $DataPeserta = PesertaPbiModel::DataPesertaPbiAll($id_periode,$id_tahun_ajaran);
        
        if ($DataPeserta == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $DataPeserta]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function AjaxDataSiswa($tahun,$periode)
    {
        $selectedIds = PesertaPbiModel::where('id_tahun_ajaran',$tahun)->where('id_periode',$periode)->pluck('id_siswa')->toArray();
        $siswa = SiswaModel::whereNotIn('id_siswa', $selectedIds)->get();
        if ($siswa->isNotEmpty()) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $siswa]);
        } else {
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }
    

    public function editData($id)
    {
        $DataPeserta = PesertaPbiModel::where('id_peserta_pbi',$id)->first();
        $DataGuru = GuruModel::whereNull('deleted_at')->get();
        $DataSiswa = SiswaModel::whereNull('deleted_at')->get();
        $DataKelas = KelasModel::whereNull('deleted_at')->get();
        if ($DataPeserta == true) {
            return response()->json(
                [
                    'success' => true, 
                    'message' => 'Data Ditemukan', 
                    'data' => $DataPeserta,
                    'data_guru'=>$DataGuru,
                    'data_siswa'=>$DataSiswa,
                    'data_kelas'=>$DataKelas
                ]
            );
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function storeData(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'id_tahun_ajaran' => 'required|string',
                'id_periode' => 'required|string',
                'peserta' => 'required|string',
                'kelas' => 'required|string',
                'guru' => 'required|string',
            ]);

            $CekData = PesertaPbiModel::where('id_tahun_ajaran', $validatedData['id_tahun_ajaran'])
            ->where('id_periode', $validatedData['id_periode'])
            ->where('id_siswa', $validatedData['peserta'])
            ->where('id_kelas', $validatedData['kelas'])
            ->where('id_guru', $validatedData['guru'])
            ->whereNull('deleted_at')->get();
            
            
            if (!$CekData->isEmpty()) {
                // If the tahun_ajaran already exists, respond with a message
                return response()->json(['success' => false, 'message' => 'Data Sudah Terdaftar']);
            } else {
                // Generate unique ID based on current date and count
                $tanggal = now()->format('dmy');
                $nomorUrut = PesertaPbiModel::whereDate('created_at', now()->toDateString())->count() + 1;
                $id = 'PES-PBI' . '-' . $tanggal . '-' . $nomorUrut;
    
                // Prepare data for insertion
                $data = [
                    'id_peserta_pbi' => $id,
                    'id_tahun_ajaran' => $validatedData['id_tahun_ajaran'],
                    'id_periode' => $validatedData['id_periode'],
                    'id_siswa' => $validatedData['peserta'],
                    'id_kelas' => $validatedData['kelas'],
                    'id_guru' => $validatedData['guru'],
                    'status_peserta_pbi' => 1,
                    'id_user' => session('user')['id'],
                ];
    
                // Store data into database
                $Peserta = PesertaPbiModel::create($data);
    
                // Check if data was successfully stored
                if ($Peserta) {
                    return response()->json(['success' => true, 'message' => 'Berhasil Tambah Data', 'data' => $Peserta]);
                } else {
                    return response()->json(['error' => true, 'message' => 'Gagal Tambah Data']);
                }
            }
    
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422);
        }catch (\Exception $e) {
            // Handle any exceptions that occur during validation or data insertion
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }
    

    public function updateData($id,Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'id_tahun_ajaran' => 'required|string',
                'id_periode' => 'required|string',
                'peserta' => 'required|string',
                'kelas' => 'required|string',
                'guru' => 'required|string',
            ]);

            $CekData = PesertaPbiModel::where('id_tahun_ajaran', $validatedData['id_tahun_ajaran'])
            ->where('id_periode', $validatedData['id_periode'])
            ->where('id_siswa', $validatedData['peserta'])
            ->where('id_kelas', $validatedData['kelas'])
            ->where('id_guru', $validatedData['guru'])
            ->whereNull('deleted_at')->get();
            
            if (!$CekData->isEmpty()) {
                // If the tahun_ajaran already exists, respond with a message
                return response()->json(['success' => false, 'message' => 'Data Sudah Terdaftar']);
            }

            $data = [
                'id_tahun_ajaran' => $validatedData['id_tahun_ajaran'],
                'id_periode' => $validatedData['id_periode'],
                'id_siswa' => $validatedData['peserta'],
                'id_kelas' => $validatedData['kelas'],
                'id_guru' => $validatedData['guru'],
            ];
            // Store data into database
            $Peserta = PesertaPbiModel::where('id_peserta_pbi',$request->id_peserta_pbi)->update($data);
    
            // Check if data was successfully stored
            if ($Peserta) {
                return response()->json(['success' => true, 'message' => 'Berhasil Edit Data', 'data' => $Peserta]);
            } else {
                return response()->json(['error' => true, 'message' => 'Gagal Edit Data']);
            }
    
        } catch (\Exception $e) {
            // Handle any exceptions that occur during validation or data insertion
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }        
    }

    public function deleteData($id)
    {
        try {
            $Peserta = PesertaPbiModel::where('id_peserta_pbi',$id);

            $data = [
                'status_peserta_pbi' => 3,
                'deleted_at' => now()->format('Y-m-d h:i:s')
            ];

            $Peserta->update($data);

            return response()->json(['success' => true, 'message' => 'Berhasil Hapus Data']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Gagal Hapus Data: ' . $e->getMessage()]);
        }
    }

    public function statusData($id, $status)
    {
        try {
            PesertaPbiModel::where('id_peserta_pbi',$id)->update(['status_peserta_pbi' => $status]); // Update status Peserta Peserta
            if ($status == 1) {
                return response()->json(['success' => true, 'message' => 'Berhasil mengaktifkan data Peserta pbi.']);
            } else {
                return response()->json(['success' => true, 'message' => 'Berhasil menonaktifkan data Peserta pbi.']);
            }
                
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Gagal: ' . $e->getMessage()]); // Tangani jika terjadi kesalahan dalam pencarian atau pembaruan
        }
    }

    public function statusDataAll($tahun,$periode, $status)
    {
        try {
            $dataCek = PesertaPbiModel::where('id_tahun_ajaran',$tahun)->where('id_periode',$periode)->get(); // Update status Peserta Peserta
            foreach ($dataCek as $key => $value) {
                PesertaPbiModel::where('id_peserta_pbi',$value->id_peserta_pbi)->update(['status_peserta_pbi' => $status]);
            }
            if ($status == 1) {
                return response()->json(['success' => true, 'message' => 'Berhasil mengaktifkan data Peserta pbi.']);
            } else {
                return response()->json(['success' => true, 'message' => 'Berhasil menonaktifkan data Peserta pbi.']);
            }
                
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Gagal: ' . $e->getMessage()]); // Tangani jika terjadi kesalahan dalam pencarian atau pembaruan
        }
    }

    public function TarikDataPeriodeLampau($IdPeriodeBaru, $IdPeriodeLampau, $tahun)
    {
        $dataBerhasilDisimpan = [];
        $dataGagalDisimpan = [];

        try {
            $DataPesertaPeriodeLampau = PesertaPbiModel::where('id_periode', $IdPeriodeLampau)->whereNull('deleted_at')->get();
            $totalData = $DataPesertaPeriodeLampau->count();
            foreach ($DataPesertaPeriodeLampau as $value) {

                $CekData = PesertaPbiModel::where('id_tahun_ajaran', $tahun)
                    ->where('id_periode', $IdPeriodeBaru)
                    ->where('id_siswa', $value['id_siswa'])
                    ->where('id_kelas', $value['id_kelas'])
                    ->where('id_guru', $value['id_guru'])
                    ->whereNull('deleted_at')
                    ->exists();
    
                if ($CekData) {
                    continue;
                }

                $tanggal = now()->format('dmy');
                $nomorUrut = PesertaPbiModel::whereDate('created_at', now()->toDateString())->count() + 1;
                $id = 'PES-PBI' . '-' . $tanggal . '-' . $nomorUrut;
    
                // Prepare data for insertion
                $data = [
                    'id_peserta_pbi' => $id,
                    'id_tahun_ajaran' => $tahun,
                    'id_periode' => $IdPeriodeBaru,
                    'id_siswa' => $value['id_siswa'],
                    'id_kelas' => $value['id_kelas'],
                    'id_guru' => $value['id_guru'],
                    'status_peserta_pbi' => 1,
                    'id_user' => session('user')['id'],
                ];
    
                // Store data into the database
                try {
                    PesertaPbiModel::create($data);
                    $dataBerhasilDisimpan[] = $value['id_siswa']; // Simpan ID siswa yang berhasil
                } catch (\Throwable $th) {
                    $dataGagalDisimpan[] = [
                        'id_siswa' => $value['id_siswa'],
                        'error' => $th->getMessage()
                    ]; // Simpan data gagal beserta error
                }
            }
    
            $jumlahBerhasil = count($dataBerhasilDisimpan);
            $jumlahGagal = count($dataGagalDisimpan);

            // Respons dengan rincian hasil proses
            return response()->json([
                'success' => true,
                'message' => 'Proses Tarik Data Selesai',
                'total_data' => $totalData,
                'berhasil_ditarik' => $jumlahBerhasil,
                'gagal_ditarik' => $jumlahGagal,
                'berhasil_disimpan' => $dataBerhasilDisimpan,
                'gagal_disimpan' => $dataGagalDisimpan
            ]);
            
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Gagal Tarik Data Periode Lampau', 'error' => $th->getMessage()]);
        }
    }
    
        
}
