<?php

namespace App\Http\Controllers\Guru;

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
use App\Models\Admin\PenilaianModel;
use App\Models\Admin\AktifitasAmalModel;
use App\Models\Admin\BidangStudiModel;
use App\Models\Admin\KarakterModel;
use App\Models\Admin\SurahModel;

use App\Pdf\CustomPdf;

class PenilaianPbiGuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:guru');
    }
    public function index(){
        $menu = 'kegiatan';
        $submenu= 'penilaian-pbi';
        return view ('Guru/kegiatan/penilaian_pbi/data_penilaian_pbi',compact('menu','submenu'));
    }

    public function AjaxDataPeriode($guru) {
        $DataPeserta = PesertaPbiModel::DataAllGuru($guru);
        if ($DataPeserta == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $DataPeserta]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function addPenilaianpbi($periode,$tahun){
        $menu = 'kegiatan';
        $submenu= 'penilaian-pbi';
        $periode = PeriodeModel::where('id_periode', $periode)->whereNull('deleted_at')->first();
        $tahun = TahunAjaranModel::where('id_tahun_ajaran', $tahun)->whereNull('deleted_at')->first();
        $judul_3 = $periode->jenis_periode === 'pbi' ? 'BINA PRIBADI ISLAM (BPI)':ucfirst($periode->jenis_periode).' '. $tahun->nama_tahun_ajaran;

        return view ('Guru/kegiatan/penilaian_pbi/add_penilaian_pbi',compact('menu','submenu','tahun','periode','judul_3'));
    }

    public function AjaxDataPesertaPenilaian($tahun,$periode,$guru){
        
        $siswa = PesertaPbiModel::DataSiswaGuru($tahun,$periode,$guru);
        if ($siswa) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan','siswa'=> $siswa]);
        } else {
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function AjaxDataNilaiPesertaPbi($periode,$tahun){
        
        try {
            $nilai_bidang_studi = BidangStudiModel::NilaiBidangStudi($periode,$tahun);
            $nilai_karakter = KarakterModel::NilaiKarakter($periode,$tahun);
            $nilai_amal = AktifitasAmalModel::NilaiAmal($periode,$tahun);
            return response()->json([
                'success' => true, 
                'message' => 'Data Ditemukan',
                'nilai_bidang_studi'=> $nilai_bidang_studi,
                'nilai_karakter'=> $nilai_karakter,
                'nilai_amal'=> $nilai_amal
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }

    }


    public function storeData(Request $request)
    {
        try {
            
            // Validate incoming request data
            $validatedData = $request->validate([
                'jenis_penilaian_kegiatan' => 'required|not_in:PILIH,other',
            ]);
            if ($validatedData['jenis_penilaian_kegiatan'] === 'bidang_studi') {
                $validatedData = $request->validate([
                    'siswa' => 'required|not_in:PILIH,other',
                    'tanggal_penilaian_pbi' => 'required|date',
                    'nilai_bidang_studi_alquran' => 'required|numeric',
                    'nilai_bidang_studi_aqidah' => 'required|numeric',
                    'nilai_bidang_studi_ibadah' => 'required|numeric',
                    'nilai_bidang_studi_hadits' => 'required|numeric',
                    'nilai_bidang_studi_sirah' => 'required|numeric',
                    'nilai_bidang_studi_tazkiyatunnafs' => 'required|numeric',
                    'nilai_bidang_studi_fikrulislam' => 'required|numeric',
                    'keterangan_penilaian_pbi' => 'required|string',
                ]);
            } else if ($validatedData['jenis_penilaian_kegiatan'] === 'karakter') {
                $validatedData = $request->validate([
                    'siswa' => 'required|not_in:PILIH,other',
                    'tanggal_penilaian_pbi' => 'required|date',
                    'nilai_karakter_aqidah' => 'required|numeric',
                    'nilai_karakter_ibadah' => 'required|numeric',
                    'nilai_karakter_kepribadian' => 'required|numeric',
                    'nilai_karakter_pribadi' => 'required|numeric',
                    'nilai_karakter_mampu' => 'required|numeric',
                    'nilai_karakter_wawasan' => 'required|numeric',
                    'nilai_kwta' => 'required|numeric',
                    'nilai_perkemahan' => 'required|numeric',
                    'nilai_mbit' => 'required|numeric',
                    'nilai_karakter_wawasan' => 'required|numeric',
                    'keterangan_penilaian_pbi' => 'required|string',
                ]);
            }else{
                $validatedData = $request->validate([
                    'siswa' => 'required|not_in:PILIH,other',
                    'tanggal_penilaian_pbi' => 'required|date',
                    'aktivitas_amal_rawatib' => 'required|numeric',
                    'aktivitas_amal_dzikir' => 'required|numeric',
                    'aktivitas_amal_puasa' => 'required|numeric',
                    'aktivitas_amal_infaq' => 'required|numeric',
                    'aktivitas_amal_sholat_wajib' => 'required|numeric',
                    'aktivitas_amal_tilawah' => 'required|numeric',
                    'aktivitas_amal_tahajud' => 'required|numeric',
                    'aktivitas_amal_dhuha' => 'required|numeric',
                    'keterangan_penilaian_pbi' => 'required|string',
                ]);
            }
            
            // Prepare data for insertion
            $sesi_pekan = $request->sesi_periode;
            if ($validatedData['jenis_penilaian_kegiatan'] === 'bidang_studi') {
                // Generate unique ID based on current date and count
                $tanggal = now()->format('dmy');
                $nomorUrut = BidangStudiModel::whereDate('created_at', now()->toDateString())->count() + 1;
                $id = 'BDS' . '-' . $tanggal . '-' . $nomorUrut;

                $CountPekan = BidangStudiModel::PekanCount($request->id_tahun_ajaran, $request->id_periode, $validatedData['siswa']);
                if ($CountPekan <= $sesi_pekan) {
                    $data = [
                        'id_bidang_studi' => $id,
                        'id_peserta_pbi' => $validatedData['siswa'],
                        'tanggal_penilaian_bidang_studi' => $validatedData['tanggal_penilaian_pbi'],
                        'pekan_bidang_studi' => $CountPekan,
                        'status_bidang_studi' => 0,
                        'ktr_bidang_studi' => $validatedData['keterangan_penilaian_pbi'],
                        'alquran' => $validatedData['nilai_bidang_studi_alquran'],
                        'aqidah' => $validatedData['nilai_bidang_studi_aqidah'],
                        'ibadah' => $validatedData['nilai_bidang_studi_ibadah'],
                        'hadits' => $validatedData['nilai_bidang_studi_hadits'],
                        'sirah' => $validatedData['nilai_bidang_studi_sirah'],
                        'tazkiyatun' => $validatedData['nilai_bidang_studi_tazkiyatunnafs'],
                        'fikrul' => $validatedData['nilai_bidang_studi_fikrulislam'],
                        'id_user' => session('user')['id'],
                    ];
                    $PenialaiSM = BidangStudiModel::create($data);
                } else {
                    return response()->json(['error' => true, 'message' => 'Sudah Memenuhi Penilaian Perperiode']);
                }
            } else if ($validatedData['jenis_penilaian_kegiatan'] === 'karakter'){
                $tanggal = now()->format('dmy');
                $nomorUrut = KarakterModel::whereDate('created_at', now()->toDateString())->count() + 1;
                $id = 'KRT' . '-' . $tanggal . '-' . $nomorUrut;

                $CountPekan = KarakterModel::PekanCount($request->id_tahun_ajaran, $request->id_periode, $validatedData['siswa']);
                if ($CountPekan <= $sesi_pekan) {
                    $data = [
                        'id_karakter' => $id,
                        'id_peserta_pbi' => $validatedData['siswa'],
                        'tanggal_penilaian_karakter' => $validatedData['tanggal_penilaian_pbi'],
                        'pekan_karakter' => $CountPekan,
                        'status_karakter' => 0,
                        'ktr_karakter' => $validatedData['keterangan_penilaian_pbi'],
                        'aqdh' => $validatedData['nilai_karakter_aqidah'],
                        'ibdh' => $validatedData['nilai_karakter_ibadah'],
                        'akhlak' => $validatedData['nilai_karakter_kepribadian'],
                        'prbd' => $validatedData['nilai_karakter_pribadi'],
                        'aqr' => $validatedData['nilai_karakter_mampu'],
                        'wwsn' => $validatedData['nilai_karakter_wawasan'],
                        'kwta' => $validatedData['nilai_kwta'],
                        'perkemahan' => $validatedData['nilai_perkemahan'],
                        'mbit' => $validatedData['nilai_mbit'],
                        'id_user' => session('user')['id'],
                    ];
                    $PenialaiSM = KarakterModel::create($data);
                } else {
                    return response()->json(['error' => true, 'message' => 'Sudah Memenuhi Penilaian Perperiode']);
                }

            }else {
                $tanggal = now()->format('dmy');
                $nomorUrut = AktifitasAmalModel::whereDate('created_at', now()->toDateString())->count() + 1;
                $id = 'AKT' . '-' . $tanggal . '-' . $nomorUrut;

                $CountPekan = AktifitasAmalModel::PekanCount($request->id_tahun_ajaran, $request->id_periode, $validatedData['siswa']);

                if ($CountPekan <= $sesi_pekan) {
                    $data = [
                        'id_aktifitas_amal' => $id,
                        'id_peserta_pbi' => $validatedData['siswa'],
                        'tanggal_penilaian_amal' => $validatedData['tanggal_penilaian_pbi'],
                        'pekan_amal' => $CountPekan,
                        'status_amal' => 0,
                        'ktr_amal' => $validatedData['keterangan_penilaian_pbi'],
                        'sholat_wajib' => $validatedData['aktivitas_amal_sholat_wajib'],
                        'tilawah' => $validatedData['aktivitas_amal_tilawah'],
                        'tahajud' => $validatedData['aktivitas_amal_tahajud'],
                        'duha' => $validatedData['aktivitas_amal_dhuha'],
                        'rawatib' => $validatedData['aktivitas_amal_rawatib'],
                        'dzikri' => $validatedData['aktivitas_amal_dzikir'],
                        'puasa' => $validatedData['aktivitas_amal_puasa'],
                        'infaq' => $validatedData['aktivitas_amal_infaq'],
                        'id_user' => session('user')['id'],
                    ];
                    $PenialaiSM = AktifitasAmalModel::create($data);
                } else {
                    return response()->json(['error' => true, 'message' => 'Sudah Memenuhi Penilaian Perperiode']);
                }
                
            }
    
            // Check if data was successfully stored
            if ($PenialaiSM) {
                return response()->json(['success' => true, 'message' => 'Berhasil Tambah Data', 'data' => $PenialaiSM]);
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

    public function deleteData($id,$kategori)
    {
        try {

            if ($kategori === 'bidang_studi') {
                $hapusNilai = BidangStudiModel::where('id_bidang_studi', $id)->delete();
            } else if ($kategori === 'karakter') {
                $hapusNilai = KarakterModel::where('id_karakter', $id)->delete();
            }else{
                $hapusNilai = AktifitasAmalModel::where('id_aktifitas_amal', $id)->delete();
            }
                        
            if ($hapusNilai) {
                return response()->json(['success' => true, 'message' => 'Data Berhasil Dihapus']);
            } else {
                return response()->json(['error' => true, 'message' => 'Data Tidak Berhasil Dihapus']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Terjadi kesalahan saat menghapus data', 'details' => $e->getMessage()]);
        }
    }

    public function kirimData($periode,$tahun,$kategori)
    {
        try {

            if ($kategori === 'bidang_studi') {

                $nilai = BidangStudiModel::NilaiBidangStudi($periode,$tahun);
                foreach ($nilai as $key => $value) {
                    $data = [
                        'status_bidang_studi' => 1,
                    ];
                    BidangStudiModel::where('id_bidang_studi',$value->id_bidang_studi)->update($data);
                }
                if ($nilai) {
                    return response()->json(['success' => true, 'message' => 'Berhasil Kirim Data','kategori' => 'bidang_studi']);
                } else {
                    return response()->json(['error' => true, 'message' => 'Tidak Berhasil Kirim Data']);
                }

            } else if ($kategori === 'karakter') {

                $nilai = KarakterModel::NilaiKarakter($periode,$tahun);
                foreach ($nilai as $key => $value) {
                    $data = [
                        'status_karakter' => 1,
                    ];
                    KarakterModel::where('id_karakter',$value->id_karakter)->update($data);
                }
                if ($nilai) {
                    return response()->json(['success' => true, 'message' => 'Berhasil Kirim Data','kategori' => 'karakter']);
                } else {
                    return response()->json(['error' => true, 'message' => 'Tidak Berhasil Kirim Data']);
                }

            } else {

                $nilai = AktifitasAmalModel::NilaiAmal($periode,$tahun);
                foreach ($nilai as $key => $value) {
                    $data = [
                        'status_amal' => 1,
                    ];
                    AktifitasAmalModel::where('id_aktifitas_amal',$value->id_aktifitas_amal)->update($data);
                }

                if ($nilai) {
                    return response()->json(['success' => true, 'message' => 'Berhasil Kirim Data','kategori' => 'aktivitas_amal']);
                } else {
                    return response()->json(['error' => true, 'message' => 'Tidak Berhasil Kirim Data']);
                }

            }
            

            
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Terjadi kesalahan saat kirim data'.$e->getMessage()]);
        }
    }

    public function DataListPenilaianKegiatan($id_periode,$id_tahun_ajaran){
        $menu = 'kegiatan';
        $submenu= 'penilaian-pbi';
        $periode = $id_periode;
        $tahun_ajaran = $id_tahun_ajaran;
        $judul_1 = PeriodeModel::where('id_periode', $id_periode)->whereNull('deleted_at')->first();
        $judul_2 = TahunAjaranModel::where('id_tahun_ajaran', $id_tahun_ajaran)->whereNull('deleted_at')->first();
        $judul_3 = $judul_1->jenis_periode === 'pbi' ? 'BINA PRIBADI ISLAM (BPI)':ucfirst($judul_1->jenis_periode).' '. $judul_2->nama_tahun_ajaran;
        return view ('Guru/kegiatan/penilaian_pbi/data_list_penilaian_pbi',compact('menu','submenu','periode','tahun_ajaran','judul_1','judul_2','judul_3'));
    }

    public function AjaxData($id_periode,$id_tahun_ajaran) {
        $DataPeserta = PesertaPbiModel::DataPesertaPbiGuru($id_periode,$id_tahun_ajaran);
        
        if ($DataPeserta == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $DataPeserta]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function DataDetailPenilaianKegiatan($tahun,$periode,$siswa,$guru,$kelas){
        $menu = 'kegiatan';
        $submenu= 'penilaian-pbi';
        $judul_1 = PeriodeModel::where('id_periode', $periode)->whereNull('deleted_at')->first();
        $judul_2 = TahunAjaranModel::where('id_tahun_ajaran', $tahun)->whereNull('deleted_at')->first();
        $judul_3 = $judul_1->jenis_periode === 'pbi' ? 'BINA PRIBADI ISLAM (BPI)':ucfirst($judul_1->jenis_periode).' '. $judul_2->nama_tahun_ajaran;
        $kegiatan =$judul_1->jenis_periode;
        return view ('Guru/kegiatan/penilaian_pbi/detail_penilaian_pbi',compact(
            'menu',
            'submenu',
            'judul_3',
            'tahun',
            'periode',
            'siswa',
            'guru',
            'kelas',
            'kegiatan',
        ));
    }

    public function AjaxDataNilaiPesertaPbiList($periode,$tahun,$siswa,$kelas){
        
        try {
            $nilai_bidang_studi = BidangStudiModel::NilaiBidangStudiList($periode,$tahun,$siswa,$kelas);
            $nilai_karakter = KarakterModel::NilaiKarakterList($periode,$tahun,$siswa,$kelas);
            $nilai_amal = AktifitasAmalModel::NilaiAmalList($periode,$tahun,$siswa,$kelas);
            $peserta = PesertaPbiModel::DataPesertaPbiDetail($periode,$tahun,$siswa,$kelas);
            $id_peserta = PesertaPbiModel::where('id_periode',$periode)->where('id_tahun_ajaran',$tahun)->where('id_siswa',$siswa)->where('id_kelas',$kelas)->first();
            $jumlah_bidang_studi = BidangStudiModel::RataNilaiRapor($periode,$tahun,$siswa);
            $jumlah_karakter = KarakterModel::RataNilaiRapor($periode,$tahun,$siswa);
            $jumlah_amal = AktifitasAmalModel::RataNilaiRapor($periode,$tahun,$siswa);
            return response()->json([
                'success' => true, 
                'message' => 'Data Ditemukan',
                'nilai_bidang_studi'=> $nilai_bidang_studi,
                'nilai_karakter'=> $nilai_karakter,
                'nilai_amal'=> $nilai_amal,
                'peserta' => $peserta,
                'jumlah_bidang_studi' => $jumlah_bidang_studi,
                'jumlah_karakter' => $jumlah_karakter,
                'jumlah_amal' => $jumlah_amal,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }

    }

    public function editDataPenilaian($id,$kategori)
    {

        try {
            if ($kategori === 'bidang_studi') {
                $nilai = BidangStudiModel::DataDetailPenialainBidangStudi($id);
                if ($nilai) {
                    return response()->json(['success' => true, 'message' => 'Berhasil Kirim Data','kategori' => 'bidang_studi', 'data'=>$nilai]);
                } else {
                    return response()->json(['error' => true, 'message' => 'Tidak Berhasil Kirim Data']);
                }
            } else if ($kategori === 'karakter') {

                $nilai = KarakterModel::DataDetailPenialainKarakter($id);
                if ($nilai) {
                    return response()->json(['success' => true, 'message' => 'Berhasil Kirim Data','kategori' => 'karakter', 'data'=>$nilai]);
                } else {
                    return response()->json(['error' => true, 'message' => 'Tidak Berhasil Kirim Data']);
                }
            } else {
                $nilai = AktifitasAmalModel::DataDetailPenialainAmal($id);
                if ($nilai) {
                    return response()->json(['success' => true, 'message' => 'Berhasil Kirim Data','kategori' => 'aktivitas_amal', 'data'=>$nilai]);
                } else {
                    return response()->json(['error' => true, 'message' => 'Tidak Berhasil Kirim Data']);
                }

            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Terjadi kesalahan saat ambil data', 'details' => $e->getMessage()]);
        }
    }

    public function updateData($id,$kategori, Request $request)
    {
        try {
            
            // Validate incoming request data
            if ($kategori === 'bidang_studi') {
                $validatedData = $request->validate([
                    'tanggal_penilaian_pbi' => 'required|date',
                    'nilai_bidang_studi_alquran' => 'required|numeric',
                    'nilai_bidang_studi_aqidah' => 'required|numeric',
                    'nilai_bidang_studi_ibadah' => 'required|numeric',
                    'nilai_bidang_studi_hadits' => 'required|numeric',
                    'nilai_bidang_studi_sirah' => 'required|numeric',
                    'nilai_bidang_studi_tazkiyatun' => 'required|numeric',
                    'nilai_bidang_studi_fikrul' => 'required|numeric',
                    'keterangan_penilaian_pbi' => 'required|string',
                ]);
            } else if ($kategori=== 'karakter') {
                $validatedData = $request->validate([
                    'tanggal_penilaian_pbi' => 'required|date',
                    'nilai_karakter_aqidah' => 'required|numeric',
                    'nilai_karakter_ibadah' => 'required|numeric',
                    'nilai_karakter_kepribadian' => 'required|numeric',
                    'nilai_karakter_pribadi' => 'required|numeric',
                    'nilai_karakter_mampu' => 'required|numeric',
                    'nilai_karakter_wawasan' => 'required|numeric',
                    'nilai_kwta' => 'required|numeric',
                    'nilai_perkemahan' => 'required|numeric',
                    'nilai_mbit' => 'required|numeric',
                    'keterangan_penilaian_pbi' => 'required|string',
                ]);
            }else{
                $validatedData = $request->validate([
                    'tanggal_penilaian_pbi' => 'required|date',
                    'aktivitas_amal_rawatib' => 'required|numeric',
                    'aktivitas_amal_dzikri' => 'required|numeric',
                    'aktivitas_amal_puasa' => 'required|numeric',
                    'aktivitas_amal_infaq' => 'required|numeric',
                    'aktivitas_amal_sholat_wajib' => 'required|numeric',
                    'aktivitas_amal_tilawah' => 'required|numeric',
                    'aktivitas_amal_tahajud' => 'required|numeric',
                    'aktivitas_amal_duha' => 'required|numeric',
                    'keterangan_penilaian_pbi' => 'required|string',
                ]);
            }
            
            // Prepare data for insertion
            if ($kategori === 'bidang_studi') {
                $data = [
                    'tanggal_penilaian_bidang_studi' => $validatedData['tanggal_penilaian_pbi'],
                    'ktr_bidang_studi' => $validatedData['keterangan_penilaian_pbi'],
                    'alquran' => $validatedData['nilai_bidang_studi_alquran'],
                    'aqidah' => $validatedData['nilai_bidang_studi_aqidah'],
                    'ibadah' => $validatedData['nilai_bidang_studi_ibadah'],
                    'hadits' => $validatedData['nilai_bidang_studi_hadits'],
                    'sirah' => $validatedData['nilai_bidang_studi_sirah'],
                    'tazkiyatun' => $validatedData['nilai_bidang_studi_tazkiyatun'],
                    'fikrul' => $validatedData['nilai_bidang_studi_fikrul'],
                ];
                $PenialaiSM = BidangStudiModel::where('id_bidang_studi',$id)->update($data);

            } else if ($kategori === 'karakter'){
                $data = [
                    'tanggal_penilaian_karakter' => $validatedData['tanggal_penilaian_pbi'],
                    'ktr_karakter' => $validatedData['keterangan_penilaian_pbi'],
                    'aqdh' => $validatedData['nilai_karakter_aqidah'],
                    'ibdh' => $validatedData['nilai_karakter_ibadah'],
                    'akhlak' => $validatedData['nilai_karakter_kepribadian'],
                    'prbd' => $validatedData['nilai_karakter_pribadi'],
                    'aqr' => $validatedData['nilai_karakter_mampu'],
                    'wwsn' => $validatedData['nilai_karakter_wawasan'],
                    'kwta' => $validatedData['nilai_kwta'],
                    'perkemahan' => $validatedData['nilai_perkemahan'],
                    'mbit' => $validatedData['nilai_mbit'],
                ];
                $PenialaiSM = KarakterModel::where('id_karakter',$id)->update($data);

            }else {
                $data = [
                    'tanggal_penilaian_amal' => $validatedData['tanggal_penilaian_pbi'],
                    'ktr_amal' => $validatedData['keterangan_penilaian_pbi'],
                    'sholat_wajib' => $validatedData['aktivitas_amal_sholat_wajib'],
                    'tilawah' => $validatedData['aktivitas_amal_tilawah'],
                    'tahajud' => $validatedData['aktivitas_amal_tahajud'],
                    'duha' => $validatedData['aktivitas_amal_duha'],
                    'rawatib' => $validatedData['aktivitas_amal_rawatib'],
                    'dzikri' => $validatedData['aktivitas_amal_dzikri'],
                    'puasa' => $validatedData['aktivitas_amal_puasa'],
                    'infaq' => $validatedData['aktivitas_amal_infaq'],
                ];
                $PenialaiSM = AktifitasAmalModel::where('id_aktifitas_amal',$id)->update($data);
            }
    
            // Check if data was successfully stored
            if ($PenialaiSM) {
                return response()->json(['success' => true, 'message' => 'Berhasil Eidt Data', 'data' => $PenialaiSM]);
            } else {
                return response()->json(['error' => true, 'message' => 'Gagal Eidt Data']);
            }
    
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422);
        }catch (\Exception $e) {
            // Handle any exceptions that occur during validation or data insertion
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function CetakKartu($periode,$tahun,$siswa,$kelas){
        $pdf = new CustomPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('KARTU BINA PRIBADI ISLAM (BPI)');

        // Remove default header/footer
        $pdf->setPrintHeader(true); // Enable custom header
        $pdf->setPrintFooter(true); // Enable custom footer

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Set margins
        $pdf->SetMargins(0.5, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetFont('dejavusans', '', 14, '', true);
        $pdf->AddPage('P', 'A4');

        $pdf->SetY(30);
        // Add content
        $nilai_bidang_studi = BidangStudiModel::NilaiBidangStudiList($periode,$tahun,$siswa,$kelas);
        $nilai_karakter = KarakterModel::NilaiKarakterList($periode,$tahun,$siswa,$kelas);
        $nilai_amal = AktifitasAmalModel::NilaiAmalList($periode,$tahun,$siswa,$kelas);
        $peserta = PesertaPbiModel::DataPesertaPbiDetail($periode,$tahun,$siswa,$kelas);

        $viewName ='Guru/kegiatan/penilaian_pbi/cetak_kartu_pbi';
        $html = view($viewName, compact('nilai_bidang_studi','nilai_karakter','nilai_amal', 'peserta'));

        
        // Print text using writeHTMLCell()
        $pdf->writeHTML($html, true, false, true, false, '');

        // Center the image
        if (file_exists(public_path('storage/' . $peserta->foto_siswa))) {
            $imagePath = asset('storage/' . $peserta->foto_siswa);
        } else {
            $imagePath = asset('assets/admin/img/avatars/pas_foto.jpg');
        }    
 
         // Correctly define the image path
        $imageWidth = 30; // Set image width (3 cm)
        $imageHeight = 40; // Set image height (4 cm)
        $x = 158; // Calculate X position for centering
        $y = 45; // Set a fixed Y position from the top
        
        // Place the image
        $pdf->Image($imagePath, $x, $y, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0, false, false, false);
           

        // Close and output PDF document
        $pdf->Output($peserta->nama_siswa.'.pdf', 'D'); // 'I' for inline display or 'D' for download
    }

        
}
