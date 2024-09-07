<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BidangStudiModel extends Model
{
    use HasFactory;
    protected $table ="penilaian_bidang_studi_pbi";
    protected $primaryKey = 'id_bidang_studi';
    public $incrementing = false; 
    protected $keyType = 'string';
    protected $fillable = [
        'id_bidang_studi', 'id_peserta_pbi', 'pekan_bidang_studi', 'tanggal_penilaian_bidang_studi', 'status_bidang_studi', 'ktr_bidang_studi', 'alquran', 'aqidah', 'ibadah', 'hadits', 'sirah', 'tazkiyatun', 'fikrul', 'id_user','deleted_at'
    ];

    public static function NilaiBidangStudi($periode, $tahun)  {
        
        $data = DB::table('penilaian_bidang_studi_pbi')
        ->join('peserta_pbi', 'penilaian_bidang_studi_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
        ->leftjoin('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->leftjoin('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->leftjoin('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
        ->leftjoin('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'penilaian_bidang_studi_pbi.*',
        )
        ->whereNull('penilaian_bidang_studi_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('peserta_pbi.id_periode', $periode)
        ->where('peserta_pbi.id_tahun_ajaran', $tahun)
        ->where('penilaian_bidang_studi_pbi.status_bidang_studi', 0)
        ->where('penilaian_bidang_studi_pbi.id_user', session('user')['id']) 
        ->get();
        return $data; // Return the result set
    }

    public static function NilaiBidangStudiList($periode, $tahun, $siswa,$kelas)  {
        
        $data = DB::table('penilaian_bidang_studi_pbi')
        ->join('peserta_pbi', 'penilaian_bidang_studi_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
        ->leftjoin('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->leftjoin('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->leftjoin('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
        ->leftjoin('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'penilaian_bidang_studi_pbi.*',
        )
        ->whereNull('penilaian_bidang_studi_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('peserta_pbi.id_periode', $periode)
        ->where('peserta_pbi.id_tahun_ajaran', $tahun)
        ->where('peserta_pbi.id_siswa', $siswa)
        ->where('peserta_pbi.id_kelas', $kelas)
        ->where('penilaian_bidang_studi_pbi.status_bidang_studi', 1)
        ->where('penilaian_bidang_studi_pbi.id_user', session('user')['id']) 
        ->get();
        return $data; // Return the result set
    }

    public static function DataDetailPenialainBidangStudi($id)  {
        
        $data = DB::table('penilaian_bidang_studi_pbi')
        ->join('peserta_pbi', 'penilaian_bidang_studi_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
        ->leftjoin('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->leftjoin('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->leftjoin('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
        ->leftjoin('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'penilaian_bidang_studi_pbi.*',
        )
        ->whereNull('penilaian_bidang_studi_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('penilaian_bidang_studi_pbi.id_bidang_studi', $id)
        ->where('penilaian_bidang_studi_pbi.status_bidang_studi', 1)
        ->where('penilaian_bidang_studi_pbi.id_user', session('user')['id']) 
        ->first();
        return $data; // Return the result set
    }

    public static function PekanCount($tahun, $periode, $peserta) {
        
        $data = DB::table('penilaian_bidang_studi_pbi')
            ->join('peserta_pbi', 'penilaian_bidang_studi_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
            ->where('peserta_pbi.id_tahun_ajaran', $tahun)
            ->where('peserta_pbi.id_periode', $periode)
            ->where('peserta_pbi.id_peserta_pbi', $peserta)
            ->where('penilaian_bidang_studi_pbi.id_user', session('user')['id'])
            ->max('penilaian_bidang_studi_pbi.pekan_amal');
    
        $nextPekan = $data ? $data + 1 : 1;
    
        return $nextPekan;
    }

    public static function NilaiBidangStudiListAll($periode, $tahun, $siswa, $guru, $kelas)  {
        
        $data = DB::table('penilaian_bidang_studi_pbi')
        ->join('peserta_pbi', 'penilaian_bidang_studi_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
        ->leftjoin('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->leftjoin('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->leftjoin('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
        ->leftjoin('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'penilaian_bidang_studi_pbi.*',
        )
        ->whereNull('penilaian_bidang_studi_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('peserta_pbi.id_periode', $periode)
        ->where('peserta_pbi.id_tahun_ajaran', $tahun)
        ->where('peserta_pbi.id_siswa', $siswa)
        ->where('peserta_pbi.id_guru', $guru)
        ->where('peserta_pbi.id_kelas', $kelas)
        ->where('penilaian_bidang_studi_pbi.status_bidang_studi', 1)
        ->get();
        return $data; // Return the result set
    }

    public static function DataBidangStudiHome($peserta, $tahun)
    {
        // Start the query
        $query = DB::table('penilaian_bidang_studi_pbi')
            ->join('peserta_pbi', 'penilaian_bidang_studi_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
            ->select(
                'penilaian_bidang_studi_pbi.*',
            )
            ->where('peserta_pbi.id_tahun_ajaran', $tahun)
            ->where('peserta_pbi.id_siswa', $peserta)
            ->get();
        // Execute the query and return the results
        return $query;
    }
    
    

    
}
