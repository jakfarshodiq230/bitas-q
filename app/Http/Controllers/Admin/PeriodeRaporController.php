<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\PeriodeModel;
use App\Models\Admin\TahunAjaranModel;
use App\Models\Admin\RaporKegiatanModel;
use App\Models\Admin\PesertaKegiatan;
class PeriodeRaporController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }
    public function index(){
        $menu = 'rapor';
        $submenu= 'periode-rapor';
        return view ('Admin/rapor/periode/data_periode',compact('menu','submenu'));
    }

    public function AjaxDataTahun(Request $request) {
        //$DataPeriode = TahunAjaranModel::whereNull('deleted_at')->where('status_tahun_ajaran',1)->get();
        $DataPeriode = PeriodeModel::DataAll();
        if ($DataPeriode) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $DataPeriode]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function AjaxDataRaporKegiatan(Request $request) {
        $DataPeriode = PeriodeModel::DataRapor();
        if ($DataPeriode) {
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
                'kegiatan' => 'required|string',
                'tggl_akhir_penilaian' => 'required|date',
                'tggl_periode' => 'required|date',
                'tanggungjawab_periode' => 'required|string',
                'pesan_periode' => 'required|string',
            ]);

            // Fetch the related periode
            $cekPeriode = PeriodeModel::where('id_periode', $validatedData['kegiatan'])
                ->where('judul_periode', 'setoran')
                ->whereNull('deleted_at')->first();
    
            if (!$cekPeriode) {
                return response()->json(['error' => true, 'message' => 'Periode tidak ditemukan']);
            }
    
            // Check if the tahun ajaran already has a rapor entry
            $cekTahun = PeriodeModel::where('id_tahun_ajaran', $cekPeriode->id_tahun_ajaran)
                ->where('jenis_periode', $cekPeriode->jenis_periode)
                ->where('jenis_kegiatan', $cekPeriode->jenis_kegiatan)
                ->where('judul_periode', 'rapor')
                ->whereNull('deleted_at')->first();
    
            if ($cekTahun) {
                return response()->json(['error' => true, 'message' => 'Rapor sudah terdaftar']);
            }
            
            $tanggal = now()->format('dmy');
            $nomorUrut = PeriodeModel::whereDate('created_at', now()->toDateString())->count() + 1;
            $id = 'PE' . '-' . $tanggal . '-' . $nomorUrut;

            // Prepare data for insertion
            $data = [
                'id_periode' => $id,
                'id_tahun_ajaran' => $cekPeriode->id_tahun_ajaran,
                'jenis_periode' => $cekPeriode->jenis_periode,
                'jenis_kegiatan' => $cekPeriode->jenis_kegiatan,
                'id_penilaian_periode' => $cekPeriode->id_periode,
                'tggl_akhir_penilaian' => $validatedData['tggl_akhir_penilaian'],
                'tggl_periode' => $validatedData['tggl_periode'],
                'tanggungjawab_periode' => $validatedData['tanggungjawab_periode'],
                'pesan_periode' => $validatedData['pesan_periode'],
                'judul_periode' => 'rapor',
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
                'kegiatan' => 'required|string',
                'tggl_akhir_penilaian' => 'required|date',
                'tggl_periode' => 'required|date',
                'tanggungjawab_periode' => 'required|string',
                'pesan_periode' => 'required|string',
            ]);

            // Fetch the related periode
            $cekPeriode = PeriodeModel::where('id_periode', $validatedData['kegiatan'])
                ->where('judul_periode', 'setoran')
                ->whereNull('deleted_at')->first();
    
            if (!$cekPeriode) {
                return response()->json(['error' => true, 'message' => 'Periode tidak ditemukan']);
            }
    

            $data = [
                'id_tahun_ajaran' => $cekPeriode->id_tahun_ajaran,
                'jenis_periode' => $cekPeriode->jenis_periode,
                'jenis_kegiatan' => $cekPeriode->jenis_kegiatan,
                'id_penilaian_periode' => $cekPeriode->id_periode,
                'tggl_akhir_penilaian' => $validatedData['tggl_akhir_penilaian'],
                'tggl_periode' => $validatedData['tggl_periode'],
                'tanggungjawab_periode' => $validatedData['tanggungjawab_periode'],
                'pesan_periode' => $validatedData['pesan_periode'],
            ];

            // Store data into database
            $Periode = PeriodeModel::where('id_periode',$request->id_periode_rapor)->update($data);
    
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
                return response()->json(['success' => true, 'message' => 'Berhasil mengaktifkan data Periode rapor.']);
            } else {
                return response()->json(['success' => true, 'message' => 'Berhasil menonaktifkan data Periode rapor.']);
            }
                
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Gagal: ' . $e->getMessage()]); // Tangani jika terjadi kesalahan dalam pencarian atau pembaruan
        }
    }


    public function PesertaRaport($tahun, $jenisRapor, $periode)
    {
        try {

            // List data periode
            $dataPeriode = PeriodeModel::where('id_periode', $periode)
            ->where('id_tahun_ajaran', $tahun)
            ->first();
            $DataPesertaPeriode = PesertaKegiatan::DataPesertaRapor($tahun, $jenisRapor, $dataPeriode->id_penilaian_periode);

            // Convert stdClass objects to arrays
            $DataPesertaPeriode = json_decode(json_encode($DataPesertaPeriode), true);
    
            foreach ($DataPesertaPeriode as $value) {
                $tanggal = now()->format('dmy');
                $nomorUrut = RaporKegiatanModel::whereDate('created_at', now()->toDateString())->count() + 1;
                $id = 'RAP' . '-' . $tanggal . '-' . $nomorUrut;
            
                // Example of checking and setting default values for missing keys
                $data = [
                    'id_rapor' => $id,
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
                        $existingRecord = RaporKegiatanModel::where('id_siswa', $value['id_siswa'])
                            ->where('id_periode', $periode)
                            ->where('id_tahun_ajaran', $value['id_tahun_ajaran'])
                            ->first();
            
                        if ($existingRecord) {
                            // Update the existing record
                            $existingRecord->update($data);
                        } else {
                            // Insert a new record
                            RaporKegiatanModel::create($data);
                        }
                    } catch (\Exception $e) {
                        // Handle exceptions
                        return response()->json(['error' => true, 'message' => $e->getMessage()]);
                    }
                }
            }
    
        } catch (\Exception $e) {
            // Handle any exceptions that occur during validation or data insertion
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }
    
        
}
