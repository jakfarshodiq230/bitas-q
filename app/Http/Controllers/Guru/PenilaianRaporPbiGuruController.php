<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Pdf\CustomPdf;

use App\Models\Admin\PeriodeModel;
use App\Models\Admin\PesertaPbiModel;
use App\Models\Admin\RaporBpiModel;
use Picqer\Barcode\BarcodeGeneratorPNG;

class PenilaianRaporPbiGuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:guru');
    }
    public function index(){
        $menu = 'rapor';
        $submenu= 'penilaian-rapor-pbi';
        return view ('Guru/pbi/peserta/data_peserta_rapor',compact('menu','submenu'));
    }

    public function AjaxData(Request $request) {
            $DataPeriode = PeriodeModel::DataPesertaRaporPbi();
        
        if ($DataPeriode == true) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $DataPeriode]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }
    
    public function DataPeserta($tahun,$jenjang,$periode){
        $menu = 'rapor';
        $submenu= 'penilaian-rapor-pbi';
        return view ('Guru/pbi/peserta/list_pesrta_rapor',compact('menu','submenu','tahun','jenjang','periode'));
    }  

    public function AjaxDataPesertaRapor($tahun,$jenjang,$periode) {
        $DataPeserta = RaporBpiModel::DataPesertaRaporPbiGuru($periode,$tahun);
        $DataPeriode = PeriodeModel:: DataPeriodeRapor($tahun,$jenjang,$periode);
        if ($DataPeriode == true) {
            return response()->json([
                'success' => true, 
                'message' => 'Data Ditemukan', 
                'peserta' => $DataPeserta,
                'periode'=>$DataPeriode,
            ]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }


    public function DataDetailPeserta($id,$peserta,$tahun,$jenjang,$periode){
        $menu = 'rapor';
        $submenu= 'penilaian-rapor-pbi';
        return view ('Guru/pbi/peserta/detail_peserta_rapor',compact('menu','submenu','id','peserta','tahun','jenjang','periode'));
    } 

    public function AjaxDataDetailPesertaRapor($id,$peserta,$tahun,$jenjang,$periode) {
        $DataNilaiPeserta = RaporBpiModel::DataAjaxPesertaRapor($id,$peserta,$tahun,$jenjang,$periode);
        if ($DataNilaiPeserta) {
            return response()->json(['success' => true, 'message' => 'Data Ditemukan', 'data' => $DataNilaiPeserta]);
        }else{
            return response()->json(['error' => true, 'message' => 'Data Tidak Ditemukan']);
        }
    }

    public function updateData($id, Request $request)
    {
        try {
            // Validate incoming request data
            if ($request->jenis_penilaian_kegiatan === 'tahfidz') {
                $validatedData = $request->validate([
                    'awal_surah_baru' => 'required |not_in:PILIH,other',
                    'akhir_surah_baru' => 'required |not_in:PILIH,other',
                    'awal_ayat_baru' => 'required|not_in:PILIH,other',
                    'akhir_ayat_baru' => 'required|not_in:PILIH,other',
                    'awal_surah_lama' => 'nullable|not_in:PILIH,other',
                    'akhir_surah_lama' => 'nullable|not_in:PILIH,other',
                    'awal_ayat_lama' => 'nullable|not_in:PILIH,other',
                    'akhir_ayat_lama' => 'nullable|not_in:PILIH,other',
                    'n_k_p_k' => 'required',
                    'n_m_p_k' => 'required',
                    'n_t_p_k' => 'required',
                    'n_th_p_k' => 'required',
                    'n_tf_p_k' => 'required',
                    'n_jk_p_k' => 'required',
                    'tggl_penilaian_p' => 'required | date',
                    'ketrangan_p' => 'required|string',
                ]);
            } else {
                $validatedData = $request->validate([
                    'awal_surah_baru' => 'required|not_in:PILIH,other',
                    'akhir_surah_baru' => 'required|not_in:PILIH,other',
                    'awal_ayat_baru' => 'required|not_in:PILIH,other',
                    'akhir_ayat_baru' => 'required|not_in:PILIH,other',
                    'awal_surah_lama' => 'nullable|not_in:PILIH,other',
                    'akhir_surah_lama' => 'nullable|not_in:PILIH,other',
                    'awal_ayat_lama' => 'nullable|not_in:PILIH,other',
                    'akhir_ayat_lama' => 'nullable|not_in:PILIH,other',
                    'n_k_p_k' => 'required',
                    'n_th_p_k' => 'required',
                    'n_jk_p_k' => 'required',
                    'tggl_penilaian_p' => 'required | date',
                    'ketrangan_p' => 'required|string',
                ]);
            }

            // Prepare data for insertion
            if ($request->jenis_penilaian_kegiatan === 'tahfidz') {
                $data = [
                    'awal_surah_baru' => $validatedData['awal_surah_baru'],
                    'akhir_surah_baru' => $validatedData['akhir_surah_baru'],
                    'awal_ayat_baru' => $validatedData['awal_ayat_baru'],
                    'akhir_ayat_baru' => $validatedData['akhir_ayat_baru'],
                    'awal_surah_lama' => $validatedData['awal_surah_lama'],
                    'akhir_surah_lama' => $validatedData['akhir_surah_lama'],
                    'awal_ayat_lama' => $validatedData['awal_ayat_lama'],
                    'akhir_ayat_lama' => $validatedData['akhir_ayat_lama'],
                    'n_k_p' => $validatedData['n_k_p_k'],
                    'n_m_p' => $validatedData['n_m_p_k'],
                    'n_t_p' => $validatedData['n_t_p_k'],
                    'n_th_p' => $validatedData['n_th_p_k'],
                    'n_tf_p' => $validatedData['n_tf_p_k'],
                    'n_jk_p' => $validatedData['n_jk_p_k'],
                    'tggl_penilaian_p' => $validatedData['tggl_penilaian_p'],
                    'ketrangan_p' => $validatedData['ketrangan_p'],
                    'id_user' => 'GR-230624-3',
                ];
            } else {
                $data = [
                    'awal_surah_baru' => $validatedData['awal_surah_baru'],
                    'akhir_surah_baru' => $validatedData['akhir_surah_baru'],
                    'awal_ayat_baru' => $validatedData['awal_ayat_baru'],
                    'akhir_ayat_baru' => $validatedData['akhir_ayat_baru'],
                    'awal_surah_lama' => $validatedData['awal_surah_lama'],
                    'akhir_surah_lama' => $validatedData['akhir_surah_lama'],
                    'awal_ayat_lama' => $validatedData['awal_ayat_lama'],
                    'akhir_ayat_lama' => $validatedData['akhir_ayat_lama'],
                    'n_k_p' => $validatedData['n_k_p_k'],
                    'n_th_p' => $validatedData['n_th_p_k'],
                    'n_jk_p' => $validatedData['n_jk_p_k'],
                    'tggl_penilaian_p' => $validatedData['tggl_penilaian_p'],
                    'ketrangan_p' => $validatedData['ketrangan_p'],
                    'id_user' => 'GR-230624-3',
                ];
            }
            
            // Store data into database
            $Penialai = PenilaianPengembanganDiriModel::where('id_pengembangan_diri',$id)->update($data);
    
            // Check if data was successfully stored
            if ($Penialai) {
                return response()->json(['success' => true, 'message' => 'Berhasil Edit Data', 'data' => $Penialai]);
            } else {
                return response()->json(['error' => true, 'message' => 'Gagal Edit Data']);
            }
    
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422);
        }catch (\Exception $e) {
            // Handle any exceptions that occur during validation or data insertion
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function CetakRapor($idRapor,$peserta,$tahun,$periode){
        $pdf = new CustomPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('RAPOR KEGIATAN');

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
        $html = view('Guru/pbi/peserta/cetak_rapor_pbi',compact('nilai'));
        
        // Print text using writeHTMLCell()
        $pdf->writeHTML($html, true, false, true, false, '');

        // Center the image
        if (file_exists(public_path('storage/' . $nilai->foto_siswa))) {
            $imagePath = public_path('storage/' . $nilai->foto_siswa);
        } else {
            $imagePath = public_path('assets/admin/img/avatars/pas_foto.jpg');
        }        
        // Close and output PDF document
        $pdf->Output($nilai->nama_siswa.'.pdf', 'D'); // 'I' for inline display or 'D' for download
    }
}
