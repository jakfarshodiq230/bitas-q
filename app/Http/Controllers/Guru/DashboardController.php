<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\TahunAjaranModel;
use App\Models\Admin\PeriodeModel;
use App\Models\Admin\PesertaKegiatan;
use App\Models\Admin\PenilaianModel;
use App\Models\Admin\PenilaianSertifikasiModel;
use App\Models\Admin\AktifitasAmalModel;
use App\Models\Admin\BidangStudiModel;
use App\Models\Admin\KarakterModel;
use App\Models\Admin\PesertaPbiModel;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\RaporBpiModel;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:guru,sanctum');
    }
    public function index(){
            $menu = 'home';
            $submenu= 'home';
            return view ('Guru/home/dashboard',compact('menu','submenu'));
    }

    public function AjaxData() {
        $Periode = PeriodeModel::Dashboard();
        if ($Periode == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $Periode]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function statistik(){
        $menu = 'home';
        $submenu= 'statistik';
        return view ('Guru/home/statistik',compact('menu','submenu'));
    }

    public function AjaxStatistikTahun() {
        $data = TahunAjaranModel::whereNull('deleted_at')->get();
        return response()->json($data);
    }

    public function AjaxStatistikPeserta($tahun) {
        $guru = session('user')['id'];
        $peserta = PesertaKegiatan::DataDashbordGuru($tahun,$guru);
        return response()->json($peserta);
    }

    public function AjaxDataStatistik($peserta, $tahun) {
        try {
            $tahfidz_baru = PenilaianModel::DataAjaxDashbort($peserta, $tahun,'tahfidz');
            $tahfidz_lama = PenilaianModel::DataAjaxDashbort($peserta, $tahun,'murajaah');
            $tahsin_baru = PenilaianModel::DataAjaxDashbort($peserta, $tahun,'tahsin');
            $tahsin_lama = PenilaianModel::DataAjaxDashbort($peserta, $tahun,'materikulasi');
            $sertifikasi = PenilaianSertifikasiModel::DataSertifDashbord($peserta, $tahun);
            $nilai_bidang_studi = BidangStudiModel::DataBidangStudiHome($peserta, $tahun);
            $nilai_karakter = KarakterModel::DataKarakterHome($peserta, $tahun);
            $nilai_amal = AktifitasAmalModel::DataAmalaHome($peserta, $tahun);
            return response()->json([
                'success' => true, 
                'message' => 'Data Ditemukan', 
                'tahfidz_baru' => $tahfidz_baru,
                'tahfidz_lama' => $tahfidz_lama,
                'tahsin_baru' => $tahsin_baru,
                'tahsin_lama' => $tahsin_lama,
                'sertifikasi' => $sertifikasi,
                'nilai_bidang_studi' => $nilai_bidang_studi,
                'nilai_karakter' => $nilai_karakter,
                'nilai_amal' => $nilai_amal,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }

    }

    public function Perkembangan(){
        $menu = 'perkembangan';
        $submenu= 'perkembangan';
        return view ('Guru/perkembangan/data_peserta',compact('menu','submenu'));
    }

    public function AjakDataPeserta() {
        try {
            $pesertta = PesertaPbiModel::PesrtaStatistikPerkembanganPbiGuru();
            return response()->json([
                'success' => true, 
                'message' => 'Data Ditemukan', 
                'data' => $pesertta,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }

    }
    
    public function DetailPerkembangan($id){
        $menu = 'perkembangan';
        $submenu= 'perkembangan';
        return view ('Guru/perkembangan/perkembangan',compact('menu','submenu','id'));
    } 

    public function AjaxDetailPerkembangan($id) {
        try {
            $peserta = SiswaModel::where('id_siswa',$id)->first();
            return response()->json([
                'success' => true, 
                'message' => 'Data Ditemukan', 
                'data' => [
                    'peserta' => $peserta,
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function AjaxNilaiGrafik($id, Request $request) {
        try {
            $fields = explode(',', $request->input('fields'));
            $grafik_nilai = RaporBpiModel::NilaiGrafikPerkembangan($id, $fields);
            return response()->json([
                'success' => true, 
                'message' => 'Data Ditemukan', 
                'data' => [
                    'grafik_nilai' => $grafik_nilai
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function AjaxPeriodeGrafik($id) {
        try {
            $periode = RaporBpiModel::DataPeriodeGrafik($id);
            return response()->json([
                'success' => true, 
                'message' => 'Data Ditemukan', 
                'data' => [
                    'periode' => $periode
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function DataAjaxGrafikDashbor($id,$periode){
        
        try {
            $periode_cek = RaporBpiModel::where('id_rapor_pbi',$periode)->first();
            $data_grafik_home = RaporBpiModel::RataGrafikHome($periode_cek->id_periode,$periode_cek->id_tahun_ajaran,$id);
            return response()->json([
                'success' => true, 
                'message' => 'Data Ditemukan',
                'data_grafik_home' => $data_grafik_home,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }

    }

    public function PanduanUser(){
        $menu = 'panduan';
        $submenu= 'panduan';
        return view ('Guru/panduan/panduan',compact('menu','submenu'));
    }
}
