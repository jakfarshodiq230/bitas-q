<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\RaporBpiModel;
use App\Models\Admin\PeriodeModel;
use App\Models\Admin\AktifitasAmalModel;
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
            return response()->json(['success' => true, 'message' => 'Berhasil Data Nilai', 'data' => $periode_rapor]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()],500);
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
        // Close and output PDF document
        $pdf->Output($nilai->nama_siswa.'.pdf', 'I'); // 'I' for inline display or 'D' for download
    }

    public function IsiMandiri(){
        $menu = 'mandiri_bpi';
        $submenu= 'mandiri_bpi';
        $periode = PeriodeModel::PeridoeMandiri();
        return view ('Siswa/bpi/isi_mandiri',compact('menu','submenu','periode'));
    }

    public function AjaxSimpanMandiri( Request $request ) {
        try {
            $validatedData = $request->validate([
                'wizard-peserta' => 'required',
                'wizard-id-tahun' => 'required',
                'wizard-id-periode' => 'required',
                'wizard-pekan' => 'required|numeric',
                'wizard-guru' => 'required',
                'wizard-tanggal' => 'required|date',
                'wizard-wajib' => 'required|numeric',
                'wizard-tilawah' => 'required|numeric',
                'wizard-tahajud' => 'required|numeric',
                'wizard-dhuha' => 'required|numeric',
                'wizard-rawatib' => 'required|numeric',
                'wizard-dzikri' => 'required|numeric',
                'wizard-puasa' => 'required|numeric',
                'wizard-infaq' => 'required|numeric',
            ]);

            $tanggal = now()->format('dmy');
            $nomorUrut = AktifitasAmalModel::whereDate('created_at', now()->toDateString())->count() + 1;
            $id = 'AKT' . '-' . $tanggal . '-' . $nomorUrut;

            $CountPekan = AktifitasAmalModel::PekanCountMandiri($validatedData['wizard-id-tahun'], $validatedData['wizard-id-periode'], $validatedData['wizard-peserta'], $validatedData['wizard-guru'],$validatedData['wizard-pekan']);
            if ($CountPekan) {
                return response()->json(['error' => true, 'message' => 'Pekan sudah diisi. Silakan pilih pekan lain.']);
            }
                $data = [
                    'id_aktifitas_amal' => $id,
                    'id_peserta_pbi' => $validatedData['wizard-peserta'],
                    'tanggal_penilaian_amal' => $validatedData['wizard-tanggal'],
                    'pekan_amal' => $validatedData['wizard-pekan'],
                    'status_amal' => 0,
                    'sholat_wajib' => $validatedData['wizard-wajib'],
                    'tilawah' => $validatedData['wizard-tilawah'],
                    'tahajud' => $validatedData['wizard-tahajud'],
                    'duha' => $validatedData['wizard-dhuha'],
                    'rawatib' => $validatedData['wizard-rawatib'],
                    'dzikri' => $validatedData['wizard-dzikri'],
                    'puasa' => $validatedData['wizard-puasa'],
                    'infaq' => $validatedData['wizard-infaq'],
                    'id_user' => $validatedData['wizard-guru'],
                    'jenis_pengisian_amal' => 'mandiri',
                ];
                $PenialaiSM = AktifitasAmalModel::create($data);
                return response()->json(['success' => true, 'message' => 'Berhasil Pengisian Mandiri Bina Pribadi Islam (BPI)']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()],500);
        }
    }

    public function AjaxNilaiMandiri() {
        try {
            $nilaiMandiri = PeriodeModel::NilaiaMandiriSiswa();
            return response()->json(['success' => true, 'message' => 'Berhasil Data Nilai Mandiri', 'data' => $nilaiMandiri]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()],500);
        }
    }

    public function AjaxPekanListMandiri() {
        try {
            $PekanList = PeriodeModel::PekanListMandiri();
            return response()->json(['success' => true, 'message' => 'Berhasil Data Nilai Mandiri', 'data' => $PekanList]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()],500);
        }
    }
}
