<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\PeriodeModel;
use App\Models\Admin\TahunAjaranModel;
use App\Models\Admin\pbiKegiatanModel;
use App\Models\Admin\PesertaKegiatan;
class PeriodePbiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }
    public function index(){
        $menu = 'pbi';
        $submenu= 'periode-pbi';
        return view ('Admin/pbi/periode/data_periode',compact('menu','submenu'));
    }

    public function AjaxDataTahun(Request $request) {
        $DataPeriode = TahunAjaranModel::whereNull('deleted_at')->where('status_tahun_ajaran',1)->get();
        if ($DataPeriode == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $DataPeriode]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function AjaxData(Request $request) {
        $DataPeriode = PeriodeModel::DataPbi();
        if ($DataPeriode == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $DataPeriode]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function editData($id)
    {
        $DataPeriode = PeriodeModel::where('id_periode',$id)->first();
        if ($DataPeriode == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $DataPeriode]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function storeData(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'tahun_ajaran' => 'required|string',
                'kegiatan' => 'required|string',
                'pekan_pbi' => 'required|string',
            ]);
    
            // Construct the nama_tahun_ajaran
            $cekTahun = PeriodeModel::where('id_tahun_ajaran', $validatedData['tahun_ajaran'])
            ->where('jenis_periode', $validatedData['kegiatan'])
            ->where('judul_periode', 'pbi')
            ->where('sesi_periode', $validatedData['pekan_pbi'])
            ->whereNull('deleted_at')->get();
            
            if (!$cekTahun->isEmpty()) {
                // If the tahun_ajaran already exists, respond with a message
                return response()->json(['success' => false, 'message' => 'Data Sudah Terdaftar']);
            } else {
                // Generate unique ID based on current date and count
                $tanggal = now()->format('dmy');
                $nomorUrut = PeriodeModel::whereDate('created_at', now()->toDateString())->count() + 1;
                $id = 'PBI' . '-' . $tanggal . '-' . $nomorUrut;
    
                // Prepare data for insertion
                $data = [
                    'id_periode' => $id,
                    'id_tahun_ajaran' => $validatedData['tahun_ajaran'],
                    'jenis_periode' => $validatedData['kegiatan'],
                    'judul_periode' => 'pbi',
                    'sesi_periode' => $validatedData['pekan_pbi'],
                    'status_periode' => '0',
                    'id_user' => session('user')['id'],
                ];
    
                // Store data into database
                $Periode = PeriodeModel::create($data);
    
                // Check if data was successfully stored
                if ($Periode) {
                    return response()->json(['success' => true, 'message' => 'Berhasil Tambah Data', 'data' => $Periode]);
                } else {
                    return response()->json(['error' => true, 'message' => 'Gagal Tambah Data']);
                }
            }
    
        } catch (\Exception $e) {
            // Handle any exceptions that occur during validation or data insertion
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }
    

    public function updateData($id,Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'tahun_ajaran' => 'required|string',
                'kegiatan' => 'required|string',
                'pekan_pbi' => 'required|numeric',
            ]);

            $data = [
                'id_tahun_ajaran' => $validatedData['tahun_ajaran'],
                'jenis_periode' => $validatedData['kegiatan'],
                'sesi_periode' => $validatedData['pekan_pbi'],
            ];

            // Store data into database
            $Periode = PeriodeModel::where('id_periode',$request->id_periode)->update($data);
    
            // Check if data was successfully stored
            if ($Periode) {
                return response()->json(['success' => true, 'message' => 'Berhasil Edit Data', 'data' => $Periode]);
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
            $Periode = PeriodeModel::where('id_periode',$id);

            $data = [
                'status_periode' => 3,
                'deleted_at' => now()->format('Y-m-d h:i:s')
            ];

            $Periode->update($data);

            return response()->json(['success' => true, 'message' => 'Berhasil Hapus Data']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Gagal Hapus Data: ' . $e->getMessage()]);
        }
    }

    public function statusData($id, $status)
    {
        try {
            PeriodeModel::where('id_periode',$id)->update(['status_periode' => $status]); // Update status periode Periode
            if ($status == 1) {
                return response()->json(['success' => true, 'message' => 'Berhasil mengaktifkan data Periode pbi.']);
            } else {
                return response()->json(['success' => true, 'message' => 'Berhasil menonaktifkan data Periode pbi.']);
            }
                
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Gagal: ' . $e->getMessage()]); // Tangani jika terjadi kesalahan dalam pencarian atau pembaruan
        }
    }


    public function Pesertapbit($tahun, $jenispbi, $periode)
    {
        try {

            // List data periode
            $dataPeriode = PeriodeModel::where('id_periode', $periode)
            ->where('id_tahun_ajaran', $tahun)
            ->first();
            $DataPesertaPeriode = PesertaKegiatan::DataPesertapbi($tahun, $jenispbi, $dataPeriode->tggl_awal_periode, $dataPeriode->tggl_akhir_periode);
            // Convert stdClass objects to arrays
            $DataPesertaPeriode = json_decode(json_encode($DataPesertaPeriode), true);
    
            foreach ($DataPesertaPeriode as $value) {
                $tanggal = now()->format('dmy');
                $nomorUrut = pbiKegiatanModel::whereDate('created_at', now()->toDateString())->count() + 1;
                $id = 'RAP' . '-' . $tanggal . '-' . $nomorUrut;
            
                // Example of checking and setting default values for missing keys
                $data = [
                    'id_pbi' => $id,
                    'id_tahun_ajaran' => $value['id_tahun_ajaran'] ?? null,
                    'id_periode' => $periode ?? null,
                    'id_siswa' => $value['id_siswa'] ?? null,
                    'id_kelas' => $value['id_kelas'] ?? null,
                    'id_guru' => $value['id_guru'] ?? null,
                    'jenis_penilaian_kegiatan' => $value['jenis_periode'] ?? null,
                    'surah_baru' => $value['surah_baru'] ?? null,
                    'surah_lama' => $value['surah_lama'] ?? null,
                    'n_j_baru' => $value['nilai_tajwid_baru'] ?? null,
                    'n_f_baru' => $value['nilai_fasohah_baru'] ?? null,
                    'n_k_baru' => $value['nilai_kelancaran_baru'] ?? null,
                    'n_g_baru' => $value['nilai_ghunnah_baru'] ?? null,
                    'n_m_baru' => $value['nilai_mad_baru'] ?? null,
                    'n_w_baru' => $value['nilai_waqof_baru'] ?? null,
                    'n_j_lama' => $value['nilai_tajwid_lama'] ?? null,
                    'n_f_lama' => $value['nilai_fasohah_lama'] ?? null,
                    'n_k_lama' => $value['nilai_kelancaran_lama'] ?? null,
                    'n_g_lama' => $value['nilai_ghunnah_lama'] ?? null,
                    'n_m_lama' => $value['nilai_mad_lama'] ?? null,
                    'n_w_lama' => $value['nilai_waqof_lama'] ?? null,
                    'id_user' => session('user')['id'],
                ];
            
                // Ensure necessary keys are present and valid before processing
                if (isset($value['id_tahun_ajaran'], $periode, $value['id_siswa'])) {
                    try {
                        // Check if the record already exists
                        $existingRecord = pbiKegiatanModel::where('id_siswa', $value['id_siswa'])
                            ->where('id_periode', $periode)
                            ->where('id_tahun_ajaran', $value['id_tahun_ajaran'])
                            ->first();
            
                        if ($existingRecord) {
                            // Update the existing record
                            $existingRecord->update($data);
                        } else {
                            // Insert a new record
                            pbiKegiatanModel::create($data);
                        }
                    } catch (\Exception $e) {
                        // Handle exceptions
                        return response()->json(['error' => true, 'message' => $e->getMessage()]);
                    }
                }
            }
    
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422);
        }catch (\Exception $e) {
            // Handle any exceptions that occur during validation or data insertion
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }
    
        
}
