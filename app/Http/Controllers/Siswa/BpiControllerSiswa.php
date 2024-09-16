<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\RaporBpiModel;
use App\Pdf\CustomPdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

class BpiControllerSiswa extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }

    public function index(){
            $menu = 'bpi';
            $submenu= 'bpi';
            return view ('Siswa/bpi/periode',compact('menu','submenu'));
    }

    public function AjaxDataPeriode() {
        try {
            $periode_rapor = RaporBpiModel::DataRaporPeserta();
            return response()->json(['success' => true, 'message' => 'Berhasil Reset Password', 'data' => $periode_rapor]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function DetailNilai($periode){
        $menu = 'bpi';
        $submenu= 'bpi';
        return view ('Siswa/bpi/detail',compact('menu','submenu','periode'));
    }

    public function AjaxNilai($periode) {
        try {
            $periode_rapor = RaporBpiModel::NilaiPesertaRapor($periode);
            return response()->json(['success' => true, 'message' => 'Berhasil Reset Password', 'data' => $periode_rapor]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function downloadRapor($periode){
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
        $nilai = RaporBpiModel::NilaiPesertaRapor($periode);
        $html = view('Siswa/bpi/cetak_rapor_pbi',compact('nilai'));
        
        // Print text using writeHTMLCell()
        $pdf->writeHTML($html, true, false, true, false, '');

        // Center the image
        if (file_exists(asset('storage/' . $nilai->foto_siswa))) {
            $imagePath = asset('storage/' . $nilai->foto_siswa);
        } else {
            $imagePath = asset('assets/admin/img/avatars/pas_foto.jpg');
        }        
        // Close and output PDF document
        $pdf->Output($nilai->nama_siswa.'.pdf', 'I'); // 'I' for inline display or 'D' for download
    }
}
