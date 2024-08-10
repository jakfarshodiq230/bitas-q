<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\PeriodeModel;
use App\Models\Admin\TahunAjaranModel;
use App\Models\Admin\RaporKegiatanModel;
use App\Models\Admin\PesertaKegiatan;
use App\Models\Guru\PenilaianPengembanganDiriModel;
use App\Pdf\CustomPdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

class PesertaRaporController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }
    public function index(){
        $menu = 'rapor';
        $submenu= 'peserta-rapor';
        return view ('Admin/rapor/peserta/data_peserta_rapor',compact('menu','submenu'));
    }

    public function AjaxData(Request $request) {
            $DataPeriode = PeriodeModel::DataPesertaRapor();
        
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
            $DataPesertaPeriode = PesertaKegiatan::DataPesertaRapor($tahun, $jenisRapor, $dataPeriode->tggl_awal_periode, $dataPeriode->tggl_akhir_periode);
    
            // Convert stdClass objects to arrays
            $DataPesertaPeriode = json_decode(json_encode($DataPesertaPeriode), true);
    
            foreach ($DataPesertaPeriode as $value) {
                $tanggal = now()->format('dmy');
                $nomorUrut = RaporKegiatanModel::whereDate('created_at', now()->toDateString())->count() + 1;
                $id = 'RAP' . '-' . $tanggal . '-' . $nomorUrut;
            
                // Example of checking and setting default values for missing keys
                $data = [
                    'id_rapor' => $id,
                    'id_tahun_ajaran' => $value['id_tahun_ajaran'] ?? null,
                    'id_periode' => $periode ?? null,
                    'id_siswa' => $value['id_siswa'] ?? null,
                    'id_kelas' => $value['id_kelas'] ?? null,
                    'id_guru' => $value['id_guru'] ?? null,
                    'jenis_penilaian_kegiatan' => $value['jenis_periode'] ?? null,
                    'surah_baru' => $value['surah_baru'] ?? null,
                    'surah_lama' => $value['surah_lama'] ?? null,
                    'n_j_baru' => $value['nilai_tajwid_baru'] ?? null,
                    'n_f_baru' => $value['nilai_fasohah_baru'] ?? null,
                    'n_k_baru' => $value['nilai_kelancaran_baru'] ?? null,
                    'n_g_baru' => $value['nilai_ghunnah_baru'] ?? null,
                    'n_m_baru' => $value['nilai_mad_baru'] ?? null,
                    'n_w_baru' => $value['nilai_waqof_baru'] ?? null,
                    'n_j_lama' => $value['nilai_tajwid_lama'] ?? null,
                    'n_f_lama' => $value['nilai_fasohah_lama'] ?? null,
                    'n_k_lama' => $value['nilai_kelancaran_lama'] ?? null,
                    'n_g_lama' => $value['nilai_ghunnah_lama'] ?? null,
                    'n_m_lama' => $value['nilai_mad_lama'] ?? null,
                    'n_w_lama' => $value['nilai_waqof_lama'] ?? null,
                    'id_user' => session('user')['id'],
                ];
            
                // Ensure necessary keys are present and valid before processing
                if (isset($value['id_tahun_ajaran'], $periode, $value['id_siswa'])) {
                    try {
                        // Check if the record already exists
                        $existingRecord = RaporKegiatanModel::where('id_siswa', $value['id_siswa'])
                            ->where('id_periode', $periode)
                            ->where('id_tahun_ajaran', $value['id_tahun_ajaran'])
                            ->first();
            
                        if ($existingRecord) {
                            // Update the existing record
                            $existingRecord->update($data);
                        } else {
                            // Insert a new record
                            RaporKegiatanModel::create($data);
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
        $menu = 'rapor';
        $submenu= 'peserta-rapor';
        return view ('Admin/rapor/peserta/list_pesrta_rapor',compact('menu','submenu','tahun','jenjang','periode'));
    }  

    public function AjaxDataPesertaRapor($tahun,$jenjang,$periode) {
        $DataPeserta = RaporKegiatanModel::DataPesertaRapor($tahun,$jenjang,$periode);
        $DataPeriode = PeriodeModel:: DataPeriodeRapor($tahun,$jenjang,$periode);
        if ($DataPeriode == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'peserta' => $DataPeserta,'periode'=>$DataPeriode]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function DataDetailPeserta($id,$peserta,$tahun,$jenjang,$periode){
        $menu = 'rapor';
        $submenu= 'peserta-rapor';
        return view ('Admin/rapor/peserta/detail_peserta_rapor',compact('menu','submenu','id','peserta','tahun','jenjang','periode'));
    } 

    public function AjaxDataDetailPesertaRapor($id,$peserta,$tahun,$jenjang,$periode) {
        $DataPeserta = RaporKegiatanModel::DataAjaxPesertaRapor($id,$peserta,$tahun,$jenjang,$periode);
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
        $pdf->AddPage('P', 'A4');

        $pdf->SetY(30);
        //Add content
        $nilai = PenilaianPengembanganDiriModel::DataAjaxPenilaianPengembanganRapor($idRapor,$peserta,$tahun,$jenjang,$periode);
        if ($jenjang === 'tahfidz') {
            $html = view('Admin/rapor/peserta/cetak_rapor_tahfidz',compact('nilai'));
        } else {
            $html = view('Admin/rapor/peserta/cetak_rapor_tahsin',compact('nilai'));
        }
        
        // Print text using writeHTMLCell()
        $pdf->writeHTML($html, true, false, true, false, '');

        // Center the image
        if (file_exists(public_path('storage/siswa/' . $nilai->foto_siswa))) {
            $imagePath = public_path('storage/siswa/' . $nilai->foto_siswa);
        } else {
            $imagePath = public_path('assets/admin/img/avatars/pas_foto.jpg');
        }        
         // Correctly define the image path
        $imageWidth = 30; // Set image width (3 cm)
        $imageHeight = 40; // Set image height (4 cm)
        $x = ($pdf->getPageWidth() - $imageWidth) / 2; // Calculate X position for centering
        $y = 230; // Set a fixed Y position from the top
        
        // Place the image
        $pdf->Image($imagePath, $x, $y, $imageWidth, $imageHeight, '', '', '', false, 300, '', false, false, 0, false, false, false);
           
        // barcode
        $url = url("cek_rapor/{$idRapor}/{$peserta}/{$tahun}/{$jenjang}/{$periode}");
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = $generator->getBarcode($url, BarcodeGeneratorPNG::TYPE_CODE_128);
        // Create a temporary file for the barcode image
        $tempBarcodeFile = tempnam(sys_get_temp_dir(), 'barcode');
        file_put_contents($tempBarcodeFile, $barcodeImage);

        $imageWidth1 = 40; // Set image width (3 cm)
        $imageHeight1 = 10; // Set image height (4 cm)
        $x1 = 150; // Calculate X position for centering
        $y1 = 262; // Set a fixed Y position from the top
        $pdf->Image($tempBarcodeFile, $x1, $y1, $imageWidth1, $imageHeight1, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);
        // Close and output PDF document
        $pdf->Output($nilai->nama_siswa.'.pdf', 'I'); // 'I' for inline display or 'D' for download
        unlink($tempBarcodeFile);
    }
}
