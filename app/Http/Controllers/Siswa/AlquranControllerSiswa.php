<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\RaporKegiatanModel;
use App\Models\Guru\PenilaianPengembanganDiriModel;
use App\Pdf\CustomPdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

class AlquranControllerSiswa extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }

    public function index(){
            $menu = 'kegiatan';
            $submenu= 'kegiatan';
            return view ('Siswa/alquran/periode',compact('menu','submenu'));
    }

    public function AjaxDataPeriode() {
        try {
            $periode_rapor = RaporKegiatanModel::DataRaporPeserta();
            return response()->json(['success' => true, 'message' => 'Berhasil Reset Password', 'data' => $periode_rapor]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function DetailNilai($periode){
        $menu = 'kegiatan';
        $submenu= 'kegiatan';
        return view ('Siswa/alquran/detail',compact('menu','submenu','periode'));
    }

    public function AjaxNilai($periode) {
        try {
            $periode_rapor = PenilaianPengembanganDiriModel::AjaxNilaiPesertaRapor($periode);
            return response()->json(['success' => true, 'message' => 'Berhasil Reset Password', 'data' => $periode_rapor]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function downloadRapor($periode,$jenjang){
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
        $pdf->AddPage('P', 'A4');

        $pdf->SetY(30);
        //Add content
        $nilai = PenilaianPengembanganDiriModel::AjaxNilaiPesertaRapor($periode);
        if ($jenjang === 'tahfidz') {
            $html = view('Admin/rapor/peserta/cetak_rapor_tahfidz',compact('nilai'));
        } else {
            $html = view('Admin/rapor/peserta/cetak_rapor_tahsin',compact('nilai'));
        }
        
        // Print text using writeHTMLCell()
        $pdf->writeHTML($html, true, false, true, false, '');

        // Center the image
        if (file_exists(asset('storage/' . $nilai->foto_siswa))) {
            $imagePath = asset('storage/' . $nilai->foto_siswa);
        } else {
            $imagePath = asset('assets/admin/img/avatars/pas_foto.jpg');
        }        
         // Correctly define the image path
        $imageWidth = 30; // Set image width (3 cm)
        $imageHeight = 40; // Set image height (4 cm)
        $x = ($pdf->getPageWidth() - $imageWidth) / 2; // Calculate X position for centering
        $y = 230; // Set a fixed Y position from the top
        
        // Place the image
        $pdf->Image($imagePath, $x, $y, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0, false, false, false);
           
        // Close and output PDF document
        $pdf->Output($nilai->nama_siswa.'.pdf', 'I'); // 'I' for inline display or 'D' for download

    }
}
