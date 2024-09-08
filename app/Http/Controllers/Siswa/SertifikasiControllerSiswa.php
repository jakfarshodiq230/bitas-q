<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\PesertaSertifikasiModel;
use App\Models\Admin\PenilaianSertifikasiModel;
use App\Pdf\CustomPdf;
use TCPDF;
use App\Pdf\CustomCetak;
use Picqer\Barcode\BarcodeGeneratorPNG;

class SertifikasiControllerSiswa extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }

    public function index(){
            $menu = 'sertifikasi';
            $submenu= 'sertifikasi';
            return view ('Siswa/sertifikasi/periode',compact('menu','submenu'));
    }

    public function AjaxDataPeriode() {
        try {
            $periode_rapor = PesertaSertifikasiModel::DataSertifikasiPeserta();
            return response()->json(['success' => true, 'message' => 'Berhasil Reset Password', 'data' => $periode_rapor]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function DetailNilai($periode){
        $menu = 'sertifikasi';
        $submenu= 'sertifikasi';
        return view ('Siswa/sertifikasi/detail',compact('menu','submenu','periode'));
    }

    public function AjaxNilai($peserta) {
        try {
            $DataPeserta = PesertaSertifikasiModel::DataIdentitasSertifPeserta($peserta);
            $Nilai = PenilaianSertifikasiModel::DataNilaiSertifikasiPeserta($peserta);
            return response()->json(['success' => true, 'message' => 'Berhasil Reset Password', 'identitas' => $DataPeserta, 'nilai' => $Nilai]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function downloadKartu($id){
        $pdf = new CustomCetak(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('SERTIFIKAT');

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
        $pdf->AddPage('L', 'A4');

        $pdf->SetY(30);
        // Add content
        $identitas = PesertaSertifikasiModel::DataIdentitasSertifPeserta($id);
        $nilai = PenilaianSertifikasiModel::DataNilaiSertifikasiPeserta($id);
        
        $viewName = 'Siswa/sertifikasi/cetak_hasil_penilaian' ;
        $html = view($viewName, compact('nilai', 'identitas'));

        
        // Print text using writeHTMLCell()
        $pdf->writeHTML($html, true, false, true, false, '');

        // Center the image
        if (file_exists(public_path('storage/' . $identitas->foto_siswa))) {
            $imagePath = public_path('storage/' . $identitas->foto_siswa);
        } else {
            $imagePath = public_path('assets/admin/img/avatars/pas_foto.jpg');
        }        
         // Correctly define the image path
        $imageWidth = 30; // Set image width (3 cm)
        $imageHeight = 40; // Set image height (4 cm)
        $x = 230; // Calculate X position for centering
        $y = 52; // Set a fixed Y position from the top
        
        // Place the image
        $pdf->Image($imagePath, $x, $y, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0, false, false, false);
           

        // Close and output PDF document
        $pdf->Output($identitas->nama_siswa.'.pdf', 'I'); // 'I' for inline display or 'D' for download
    }

    public function downloadSertif($id) {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(330.2, 215.9), true, 'UTF-8', false);
    
        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('SERTIFIKAT');
    
        // Remove default header/footer
        $pdf->setPrintHeader(false); // Disable default header
        $pdf->setPrintFooter(false); // Disable default footer
    
        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
        // Set margins
        $pdf->SetMargins(0, 0, 0, 0);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);
    
        // Set auto page breaks
        $pdf->SetAutoPageBreak(FALSE, 0);
    
        // Set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
        // Add a page with F4 landscape size
        $pdf->AddPage('L', array(330.2, 215.9));

        $identitas = PesertaSertifikasiModel::DataIdentitasSertifPeserta($id);
        $nilai = PenilaianSertifikasiModel::DataNilaiSertifikasiPeserta($id);
        $nilai_ktr = PenilaianSertifikasiModel::DataRenkNilaiSertifikasiPeserta($id);

        $nama_sertif = strtoupper($identitas->nama_siswa);
        $juz_sertif = 'Telah Mengikuti Ujian Hafalan '.$identitas->juz_periode.' Juz';
        $nilai_sertif = 'Dan Dinyatakan Lulus Dengan Predikat '.$nilai_ktr['grade'];
        // Set background image
        $backgroundImagePath = public_path('storage/sertifikat/' . $identitas->file_periode);
        $pdf->Image($backgroundImagePath, 0, 0, 330.2, 215.9, '', '', '', false, 300, '', false, false, 0);

        // Set font
        $pdf->SetFont('times', '', 24, '', true);
        // Set text color (optional)
        $pdf->SetTextColor(0, 0, 0); // RGB value for black
        // Add text to the PDF
        $pdf->SetXY(0, 110); // Set position (X, Y)
        $pdf->Cell(0, 0, $nama_sertif, 0, 1, 'C');

        // Set text color to white
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('times', '', 16, '', true);
        $pdf->SetXY(0, 124); // Set position (X, Y)
        $pdf->Cell(0, 0, $juz_sertif, 0, 1, 'C');

        $pdf->SetTextColor(0, 0, 0); // RGB value for black
        $pdf->SetXY(0, 135); // Set position (X, Y)
        $pdf->Cell(0, 0, $nilai_sertif, 0, 1, 'C');

        $pdf->AddPage('L', array(330.2, 215.9));
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
        $viewName = 'Siswa/sertifikasi/cetak_penilaian' ;
        $html = view($viewName, compact('nilai', 'identitas'));

        // Print text using writeHTMLCell()
        $pdf->writeHTML($html, true, false, true, false, '');
        $file_name = $nama_sertif.'.pdf';
        // Output PDF
        $pdf->Output($file_name, 'I');
    }
}
