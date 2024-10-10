<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Admin\PeriodeModel;
use App\Models\Admin\KelasModel;
use App\Models\Admin\RaporKegiatanModel;
use App\Models\Admin\PesertaKegiatan;
use App\Models\Admin\PesertaPbiModel;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NilaiRapor;
use App\Exports\NilaiKegiatan;
use App\Exports\NilaiSertifikasi;
use App\Exports\NilaiBpi;



class RekapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    public function index(){
        $menu = 'rekap';
        $submenu= 'rekap-rapor';
        return view ('Admin/rekap/rapor',compact('menu','submenu'));
    }
     
    
    public function periode()
    {
        try {
            $periode = PeriodeModel::DataRaporRekap();
            $kelas = KelasModel::whereNull('deleted_at')->get();
            $response = [
                'periode' => $periode,
                'kelas' => $kelas,
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No result'
            ], Response::HTTP_FORBIDDEN);
        }
    }

    public function cetakExcel($idPeriode, $IdKelas)
    {
        try {
            $cekKegiatan = PeriodeModel:: where('id_periode',$idPeriode)->first();
            if ($cekKegiatan->jenis_periode === 'pbi') {
                $export = new NilaiBpi($idPeriode, $IdKelas);
                $filename = 'RAPOR_BPI_' . date('Y-m-d') . '.xlsx';
                return Excel::download($export, $filename);
            } else {
                $export = new NilaiRapor($idPeriode, $IdKelas);
                $filename = 'RAPOR_' . date('Y-m-d') . '.xlsx';
                return Excel::download($export, $filename);
            }
                      
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422);
        }catch (\Exception $e) {
            return response()->json([
                'exception' => $e->getMessage(),
                'idPeriode' => $idPeriode,
                'IdKelas' => $IdKelas
            ], Response::HTTP_FORBIDDEN);
        }
    }

    public function kegiatan(){
        $menu = 'rekap';
        $submenu= 'rekap-kegiatan';
        return view ('Admin/rekap/kegiatan',compact('menu','submenu'));
    }

    public function PeriodeKegiatan()
    {
        try {
            $periode = PeriodeModel::DataAllRekap();
            $kelas = KelasModel::whereNull('deleted_at')->get();
            $response = [
                'periode' => $periode,
                'kelas' => $kelas,
            ];
            return response()->json($response, Response::HTTP_OK);
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422);
        }catch (\Exception $e) {
            return response()->json([
                'error' => 'No result'
            ], Response::HTTP_FORBIDDEN);
        }
    }

    public function SiswaKegiatan($idPeriode, $IdKelas,$Jenis)
    {
        try {
            if ($Jenis === 'setoran') {
                $siswa = PesertaKegiatan::PesertaExcel($idPeriode, $IdKelas);
                $response = [
                    'siswa' => $siswa,
                ];
                return response()->json($response, Response::HTTP_OK);
            } else {
                $siswa = PesertaPbiModel::PesertaPbiExcel($idPeriode, $IdKelas);
                $response = [
                    'siswa' => $siswa,
                ];
                return response()->json($response, Response::HTTP_OK);
            }
            
            
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422);
        }catch (\Exception $e) {
            return response()->json([
                'error' => 'No result'
            ], Response::HTTP_FORBIDDEN);
        }
    }

    public function cetakExcelKegiatan($idPeriode, $IdKelas, $idSiswa)
    {
        try {
            $export = new NilaiKegiatan($idPeriode, $IdKelas, $idSiswa);
            $filename = 'Kegiatan' . date('Y-m-d') . '.xlsx';
            return Excel::download($export, $filename);
            
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422);
        }catch (\Exception $e) {
            return response()->json([
                'exception' => $e->getMessage(),
                'idPeriode' => $idPeriode,
                'IdKelas' => $IdKelas
            ], Response::HTTP_FORBIDDEN);
        }
    }

    public function sertifikasi(){
        $menu = 'rekap';
        $submenu= 'rekap-sertifikasi';
        return view ('Admin/rekap/sertifikasi',compact('menu','submenu'));
    }

    public function PeriodeSertifikasi()
    {
        try {
            $periode = PeriodeModel::DataSertifikat();
            $response = [
                'periode' => $periode,
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No result'
            ], Response::HTTP_FORBIDDEN);
        }
    }

    public function cetakExcelsertifikasi($idPeriode)
    {
        try {
            $export = new NilaiSertifikasi($idPeriode);
            $filename = 'Sertifikasi' . date('Y-m-d') . '.xlsx';
            return Excel::download($export, $filename);
            
        } catch (\Exception $e) {
            return response()->json([
                'exception' => $e->getMessage(),
                'idPeriode' => $idPeriode,
            ], Response::HTTP_FORBIDDEN);
        }
    }

}
