<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\PeriodeModel;
use App\Models\Admin\TahunAjaranModel;
use App\Models\Admin\RaporBpiModel;
use App\Models\Admin\PesertaPbiModel;
class PeriodeRaporPbiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }
    public function index(){
        $menu = 'rapor-pbi';
        $submenu= 'periode-rapor-pbi';
        return view ('Admin/rapor_pbi/periode/data_periode',compact('menu','submenu'));
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
            $DataPeriode = PeriodeModel::DataRaporPbi();
        
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
                'jenis_kegiatan' => 'required|string',
                'tggl_awal_periode' => 'required|date',
                'tggl_akhir_periode' => 'required|date',
                'tggl_akhir_penilaian' => 'required|date',
                'tggl_periode' => 'required|date',
                'tanggungjawab_periode' => 'required|string',
                'pesan_periode' => 'required|string',
            ]);
    
            // Construct the nama_tahun_ajaran
            $cekTahun = PeriodeModel::where('id_tahun_ajaran', $validatedData['tahun_ajaran'])
            ->where('jenis_periode', $validatedData['kegiatan'])
            ->where('jenis_kegiatan', $validatedData['jenis_kegiatan'])
            ->where('judul_periode', 'rapor')
            ->whereNull('deleted_at')->get();
            
            $tanggal = now()->format('dmy');
            $nomorUrut = PeriodeModel::whereDate('created_at', now()->toDateString())->count() + 1;
            $id = 'PBI' . '-' . $tanggal . '-' . $nomorUrut;


            if (!$cekTahun->isEmpty()) {
                // If the tahun_ajaran already exists, respond with a message
                return response()->json(['success' => false, 'message' => 'Rapor Sudah Terdaftar']);
            } else {
                // Generate unique ID based on current date and count
                
    
                // Prepare data for insertion
                $data = [
                    'id_periode' => $id,
                    'id_tahun_ajaran' => $validatedData['tahun_ajaran'],
                    'jenis_periode' => $validatedData['kegiatan'],
                    'jenis_kegiatan' => $validatedData['jenis_kegiatan'],
                    'tggl_awal_periode' => $validatedData['tggl_awal_periode'],
                    'tggl_akhir_periode' => $validatedData['tggl_akhir_periode'],
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
                'jenis_kegiatan' => 'required|string',
                'tggl_awal_periode' => 'required|date',
                'tggl_akhir_periode' => 'required|date',
                'tggl_akhir_penilaian' => 'required|date',
                'tggl_periode' => 'required|date',
                'tanggungjawab_periode' => 'required|string',
                'pesan_periode' => 'required|string',
            ]);

            $data = [
                'id_tahun_ajaran' => $validatedData['tahun_ajaran'],
                'jenis_periode' => $validatedData['kegiatan'],
                'jenis_kegiatan' => $validatedData['jenis_kegiatan'],
                'tggl_awal_periode' => $validatedData['tggl_awal_periode'],
                'tggl_akhir_periode' => $validatedData['tggl_akhir_periode'],
                'tggl_akhir_penilaian' => $validatedData['tggl_akhir_penilaian'],
                'tggl_periode' => $validatedData['tggl_periode'],
                'tanggungjawab_periode' => $validatedData['tanggungjawab_periode'],
                'pesan_periode' => $validatedData['pesan_periode'],
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
            $DataPesertaPeriode = PesertaPbiModel::DataPesertaRapor($tahun, $jenisRapor, $dataPeriode->tggl_awal_periode, $dataPeriode->tggl_akhir_periode);
            // Convert stdClass objects to arrays
            $DataPesertaPeriode = json_decode(json_encode($DataPesertaPeriode), true);
    
            foreach ($DataPesertaPeriode as $value) {
                $tanggal = now()->format('dmy');
                $nomorUrut = RaporBpiModel::whereDate('created_at', now()->toDateString())->count() + 1;
                $id = 'RAP-PBI' . '-' . $tanggal . '-' . $nomorUrut;
            
                // Example of checking and setting default values for missing keys
                $data = [
                    'id_rapor_pbi' => $id,
                    'id_tahun_ajaran' => $value['id_tahun_ajaran'] ?? null,
                    'id_periode' => $periode ?? null,
                    'id_siswa' => $value['id_siswa'] ?? null,
                    'id_kelas' => $value['id_kelas'] ?? null,
                    'id_guru' => $value['id_guru'] ?? null,
                    'alquran' => $value['alquran'] ?? null,
                    'aqidah' => $value['aqidah'] ?? null,
                    'hadits' => $value['hadits'] ?? null,
                    'sirah' => $value['sirah'] ?? null,
                    'tazkiyatun' => $value['tazkiyatun'] ?? null,
                    'fikrul' => $value['fikrul'] ?? null,
                    'aqdh' => $value['aqdh'] ?? null,
                    'ibdh' => $value['ibdh'] ?? null,
                    'akhlak' => $value['akhlak'] ?? null,
                    'prbd' => $value['prbd'] ?? null,
                    'aqr' => $value['aqr'] ?? null,
                    'wwsn' => $value['wwsn'] ?? null,
                    'kwta' => $value['kwta'] ?? null,
                    'perkemahan' => $value['perkemahan'] ?? null,
                    'mbit' => $value['mbit'] ?? null,
                    'sholat_wajib' => $value['sholat_wajib'] ?? null,
                    'tilawah' => $value['tilawah'] ?? null,
                    'tahajud' => $value['tahajud'] ?? null,
                    'duha' => $value['duha'] ?? null,
                    'rawatib' => $value['rawatib'] ?? null,
                    'dzikri' => $value['dzikri'] ?? null,
                    'puasa' => $value['puasa'] ?? null,
                    'infaq' => $value['infaq'] ?? null,
                    'id_user' => session('user')['id'],
                ];
            
                // Ensure necessary keys are present and valid before processing
                if (isset($value['id_tahun_ajaran'], $periode, $value['id_siswa'])) {
                    try {
                        // Check if the record already exists
                        $existingRecord = RaporBpiModel::where('id_siswa', $value['id_siswa'])
                            ->where('id_periode', $periode)
                            ->where('id_tahun_ajaran', $value['id_tahun_ajaran'])
                            ->first();
            
                        if ($existingRecord) {
                            // Update the existing record
                            $existingRecord->update($data);
                        } else {
                            // Insert a new record
                            RaporBpiModel::create($data);
                        }
                    } catch (\Exception $e) {
                        // Handle exceptions
                        return response()->json(['error' => true, 'message' => $e->getMessage()]);
                    }
                }
            }
            PeriodeModel::where('id_periode',$periode)->update(['status_periode' => 0]);
    
        } catch (\Exception $e) {
            // Handle any exceptions that occur during validation or data insertion
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }
    
        
}
