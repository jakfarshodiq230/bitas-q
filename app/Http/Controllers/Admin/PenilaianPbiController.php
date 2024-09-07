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
use App\Models\Admin\BidangStudiModel;
use App\Models\Admin\KarakterModel;
use App\Models\Admin\AktifitasAmalModel;

class PenilaianPbiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }
    public function index(){
        $menu = 'pbi';
        $submenu= 'penilaian-pbi';
        return view ('Admin/pbi/penilaian/data_penilaian_kegiatan',compact('menu','submenu'));
    }

    public function AjaxDataPeriode(Request $request) {
        $DataPeserta = PesertaPbiModel::DataAll();
        if ($DataPeserta == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $DataPeserta]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function DataListPenilaianKegiatan($id_periode,$id_tahun_ajaran){
        $menu = 'pbi';
        $submenu= 'penilaian-pbi';
        $periode = $id_periode;
        $tahun_ajaran = $id_tahun_ajaran;
        $judul_1 = PeriodeModel::where('id_periode', $id_periode)->whereNull('deleted_at')->first();
        $judul_2 = TahunAjaranModel::where('id_tahun_ajaran', $id_tahun_ajaran)->whereNull('deleted_at')->first();
        $judul_3 = ucfirst($judul_1->jenis_periode).' '. $judul_2->nama_tahun_ajaran;
        return view ('Admin/pbi/penilaian/data_list_penilaian_kegiatan',compact('menu','submenu','periode','tahun_ajaran','judul_1','judul_2','judul_3'));
    }

    public function AjaxData($id_periode,$id_tahun_ajaran) {
        $DataPeserta = PesertaPbiModel::DataPesertapbiAll($id_periode,$id_tahun_ajaran);
        
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


    public function DetailPenilaianKegiatan(){
        $menu = 'pbi';
        $submenu= 'penilaian-pbi';
        return view ('Admin/pbi/penilaian/detail_penilaian_kegiatan',compact('menu','submenu'));
    }

    public function DataDetailPenilaianKegiatan($tahun,$periode,$siswa,$guru,$kelas){
        $menu = 'pbi';
        $submenu= 'penilaian-pbi';
        $judul_1 = PeriodeModel::where('id_periode', $periode)->whereNull('deleted_at')->first();
        $judul_2 = TahunAjaranModel::where('id_tahun_ajaran', $tahun)->whereNull('deleted_at')->first();
        $judul_3 = ucfirst($judul_1->jenis_periode).' '. $judul_2->nama_tahun_ajaran;
        $kegiatan =$judul_1->jenis_periode;
        return view ('Admin/pbi/penilaian/detail_penilaian_kegiatan',compact(
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

    public function AjaxDataDetailPenilaianKegiatan($tahun,$periode,$siswa,$guru,$kelas){
        
        try {
            $nilai_bidang_studi = BidangStudiModel::NilaiBidangStudiListAll($periode,$tahun,$siswa,$guru,$kelas);
            $nilai_karakter = KarakterModel::NilaiKarakterListAll($periode,$tahun,$siswa,$guru,$kelas);
            $nilai_amal = AktifitasAmalModel::NilaiAmalListAll($periode,$tahun,$siswa,$guru,$kelas);
            $peserta = PesertaPbiModel::DataPesertaPbiDetailAll($periode,$tahun,$siswa,$guru,$kelas);
            $id_peserta = PesertaPbiModel::where('id_periode',$periode)->where('id_tahun_ajaran',$tahun)->where('id_siswa',$siswa)->where('id_kelas',$kelas)->first();
            $jumlah_bidang_studi = BidangStudiModel::where('id_peserta_pbi',$id_peserta['id_peserta_pbi'])->max('pekan_bidang_studi');
            $jumlah_karakter = KarakterModel::where('id_peserta_pbi',$id_peserta['id_peserta_pbi'])->max('pekan_karakter');
            $jumlah_amal = AktifitasAmalModel::where('id_peserta_pbi',$id_peserta['id_peserta_pbi'])->max('pekan_amal');
            
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
        
}
