<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TahunAjaranModel;
use App\Models\Admin\PeriodeModel;
use App\Models\Admin\SiswaModel;
use App\Models\Admin\AdminModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\LogAksesModel;
use App\Models\Admin\PesertaKegiatan;
use App\Models\Admin\PenilaianModel;
use App\Models\Admin\PenilaianSertifikasiModel;
use App\Models\Admin\AktifitasAmalModel;
use App\Models\Admin\BidangStudiModel;
use App\Models\Admin\KarakterModel;
use App\Models\Admin\PesertaPbiModel;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }
    public function index(){
        $menu = 'home';
        $submenu= 'home';
        return view ('Admin/home/dashboard',compact('menu','submenu'));
    }

    public function AjaxDataPeriode() {
        $Peserta = SiswaModel::whereNull('deleted_at')->count();
        $Admin = AdminModel::whereNull('deleted_at')->count();
        $Tahsin = PeriodeModel::where('judul_periode','setoran')->where('jenis_periode','tahsin')->whereNull('deleted_at')->count();
        $Tahfidz = PeriodeModel::where('judul_periode','setoran')->where('jenis_periode','tahfidz')->whereNull('deleted_at')->count();
        $Sertifikasi = PeriodeModel::where('judul_periode','sertifikasi')->whereNull('deleted_at')->count();
        $Periode = PeriodeModel::whereNull('deleted_at')->count();
        $TahunAjaran = TahunAjaranModel::whereNull('deleted_at')->count();
        $Kelas = KelasModel::whereNull('deleted_at')->count();
        $PresentaseSetoran = PeriodeModel::PresentasePeriode();
        return response()->json([
            'success' => true, 
            'message' => 'Data Ditemukan', 
            'peserta' => $Peserta,
            'Admin' => $Admin,
            'tahsin' => $Tahsin,
            'tahfidz' => $Tahfidz,
            'sertifikasi' => $Sertifikasi,
            'periode' => $Periode,
            'tahun' => $TahunAjaran,
            'kelas' => $Kelas,
            'PresentaseSetoran' => $PresentaseSetoran
        ]);
    }

    public function LogLogin(){
        $menu = 'home';
        $submenu= 'log';
        return view ('Admin/home/logLogin',compact('menu','submenu'));
    }

    public function AjaxDataLog() {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();


        $Log = LogAksesModel::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->orderBy('created_at', 'DESC')
                ->get();
        $Persentase = LogAksesModel::Persentase();
        return response()->json([
            'success' => true, 
            'message' => 'Data Ditemukan', 
            'Log' => $Log,
            'Persentase' => $Persentase,
        ]);
    }

    public function Histori(){
        $menu = 'home';
        $submenu= 'histori';
        return view ('Admin/home/histori',compact('menu','submenu'));
    }

    public function AjaxHistoriTahun() {
        $data = TahunAjaranModel::whereNull('deleted_at')->get();
        return response()->json($data);
    }

    public function AjaxHistoriPeserta($tahun) {
        $Admin = session('user')['level_user'] === 'Admin' ? session('user')['id'] : null;
        $peserta = PesertaKegiatan::DataDashbordAdmin($tahun,$Admin);
        return response()->json($peserta);
    }

    public function AjaxDataHistori($peserta, $tahun) {
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
        return view ('Admin/perkembangan/data_peserta',compact('menu','submenu'));
    }

    public function AjakDataPeserta() {
        try {
            $pesertta = PesertaPbiModel::PesrtaStatistikPerkembanganPbiAll();
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
        return view ('Admin/perkembangan/perkembangan',compact('menu','submenu','id'));
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
}
