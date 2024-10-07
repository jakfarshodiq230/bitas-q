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
        if (!$nilai) {
            // Return JSON response with an error if data is not found
            return response()->json(['error' => 'Data not found or invalid. Please try again.'], 404);
        }
        $html = ($jenjang === 'tahfidz')
        ? view('Admin/rapor/peserta/cetak_rapor_tahfidz', compact('nilai'))
        : view('Admin/rapor/peserta/cetak_rapor_tahsin', compact('nilai'));

        $pdf->writeHTML($html, true, false, true, false, '');
        if (file_exists(storage_path('app/public/' . $nilai->foto_siswa))) {
            $imagePath = storage_path('app/public/' . $nilai->foto_siswa);
        } else {
            $imagePath = public_path('assets/admin/img/avatars/pas_foto.jpg');
        }

        $imageWidth = 30; // Set image width (3 cm)
        $imageHeight = 40; // Set image height (4 cm)
        $x = ($pdf->getPageWidth() - $imageWidth) / 2; 
        $y = 230;
        
        // Place the image
        $pdf->Image($imagePath, $x, $y, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0, false, false, false);
        $pdf->Output($nilai->nama_siswa.'.pdf', 'I'); // 'I' for inline display or 'D' for download

    }
}
