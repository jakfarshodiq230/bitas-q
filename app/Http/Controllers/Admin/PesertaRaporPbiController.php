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
use App\Models\Guru\PenilaianPengembanganDiriModel;
use App\Pdf\CustomPdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

class PesertaRaporPbiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }
    public function index(){
        $menu = 'rapor-pbi';
        $submenu= 'peserta-rapor-pbi';
        return view ('Admin/rapor_pbi/peserta/data_peserta_rapor',compact('menu','submenu'));
    }

    public function AjaxData(Request $request) {
            $DataPeriode = PeriodeModel::DataPesertaRaporPbi();
        
        if ($DataPeriode == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $DataPeriode]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function SyncRapor($tahun, $jenisRapor, $periode)
    {
        try {
            // List data periode
            $dataPeriode = PeriodeModel::where('id_periode', $periode)
            ->where('id_tahun_ajaran', $tahun)
            ->first();
            $DataPesertaPeriode = PesertaPbiModel::DataPesertaRapor($tahun, $jenisRapor, $dataPeriode->id_penilaian_periode);

            if (!$DataPesertaPeriode) {
                return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan'], 404);
            }
            // Convert stdClass objects to arrays
            $DataPesertaPeriode = json_decode(json_encode($DataPesertaPeriode), true);
    
            foreach ($DataPesertaPeriode as $value) {
                $tanggal = now()->format('dmy');
                $nomorUrut = RaporBpiModel::whereDate('created_at', now()->toDateString())->count() + 1;
                $id = 'RAP' . '-' . $tanggal . '-' . $nomorUrut;
            
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
                    'ibadah' => $value['ibadah'] ?? null,
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
                            RaporBpiModel::where('id_rapor_pbi', $existingRecord->id_rapor_pbi)->update($data);
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
    
        } catch (\Exception $e) {
            // Handle any exceptions that occur during validation or data insertion
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }
    
    public function DataPeserta($tahun,$jenjang,$periode){
        $menu = 'rapor-pbi';
        $submenu= 'peserta-rapor-pbi';
        return view ('Admin/rapor_pbi/peserta/list_pesrta_rapor',compact('menu','submenu','tahun','jenjang','periode'));
    }  

    public function AjaxDataPesertaRapor($tahun,$jenjang,$periode) {
        try {
            $DataPeserta = RaporBpiModel::DataPesertaRapor($tahun,$periode);
            $DataPeriode = PeriodeModel:: DataPeriodeRapor($tahun,$jenjang,$periode);
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'peserta' => $DataPeserta,'periode'=>$DataPeriode]);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function DataDetailPeserta($id,$peserta,$tahun,$jenjang,$periode){
        $menu = 'rapor-pbi';
        $submenu= 'peserta-rapor-pbi';
        return view ('Admin/rapor_pbi/peserta/detail_peserta_rapor',compact('menu','submenu','id','peserta','tahun','jenjang','periode'));
    } 

    public function AjaxDataDetailPesertaRapor($id,$peserta,$tahun,$jenjang,$periode) {
        $DataPeserta = RaporBpiModel::DataAjaxPesertaRapor($id,$peserta,$tahun,$jenjang,$periode);
        if ($DataPeserta) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $DataPeserta]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function CetakRaporPdf($idRapor,$peserta,$tahun,$jenjang,$periode){
        $pdf = new CustomPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Rapor Peserta');

        // Remove default header/footer
        $pdf->setPrintHeader(true); // Enable custom header
        $pdf->setPrintFooter(true); // Enable custom footer

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetFont('dejavusans', '', 14, '', true);
        $pdf->AddPage('P', 'F4');

        $pdf->SetY(30);
        //Add content
        $nilai = RaporBpiModel::DataAjaxPenilaianPengembanganRapor($idRapor,$peserta,$tahun,$periode);
        $html = view('Admin/rapor_pbi/peserta/cetak_rapor_pbi',compact('nilai'));
        
        // Print text using writeHTMLCell()
        $pdf->writeHTML($html, true, false, true, false, '');

        // Center the image
        if (file_exists(public_path('storage/' . $nilai->foto_siswa))) {
            $imagePath = public_path('storage/' . $nilai->foto_siswa);
        } else {
            $imagePath = public_path('assets/admin/img/avatars/pas_foto.jpg');
        }        
        // Close and output PDF document
        $pdf->Output($nilai->nama_siswa.'.pdf', 'I'); // 'I' for inline display or 'D' for download
    }
}
