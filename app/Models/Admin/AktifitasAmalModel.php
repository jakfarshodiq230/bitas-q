<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Scopes\ExcludePasswordScope;

class AktifitasAmalModel extends Model
{
    use HasFactory;
    protected $table ="penilaian_aktifitas_amal_pbi";
    protected $primaryKey = 'id_aktifitas_amal';
    public $incrementing = false; 
    protected $keyType = 'string';
    protected $fillable = [
        'id_aktifitas_amal', 'id_peserta_pbi', 'tanggal_penilaian_amal', 'status_amal', 'pekan_amal', 'ktr_amal','jenis_pengisian_amal', 'sholat_wajib', 'tilawah', 'tahajud', 'duha', 'rawatib', 'dzikri', 'puasa', 'infaq', 'id_user','deleted_at'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ExcludePasswordScope());
    }

    public static function NilaiAmal($periode, $tahun)  {
        
        $data = DB::table('penilaian_aktifitas_amal_pbi')
        ->join('peserta_pbi', 'penilaian_aktifitas_amal_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
        ->leftjoin('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->leftjoin('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->leftjoin('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
        ->leftjoin('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'penilaian_aktifitas_amal_pbi.*',
        )
        ->whereNull('penilaian_aktifitas_amal_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('peserta_pbi.id_periode', $periode)
        ->where('peserta_pbi.id_tahun_ajaran', $tahun)
        ->where('penilaian_aktifitas_amal_pbi.status_amal', 0)
        ->where('penilaian_aktifitas_amal_pbi.id_user', session('user')['id']) 
        ->get();
        return $data; // Return the result set
    }

    public static function NilaiAmalList($periode, $tahun,$siswa,$kelas)  {
        
        $data = DB::table('penilaian_aktifitas_amal_pbi')
        ->join('peserta_pbi', 'penilaian_aktifitas_amal_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
        ->leftjoin('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->leftjoin('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->leftjoin('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
        ->leftjoin('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'penilaian_aktifitas_amal_pbi.*',
        )
        ->whereNull('penilaian_aktifitas_amal_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('peserta_pbi.id_periode', $periode)
        ->where('peserta_pbi.id_tahun_ajaran', $tahun)
        ->where('peserta_pbi.id_siswa', $siswa)
        ->where('peserta_pbi.id_kelas', $kelas)
        ->where('penilaian_aktifitas_amal_pbi.status_amal', 1)
        ->where('penilaian_aktifitas_amal_pbi.id_user', session('user')['id']) 
        ->get();
        return $data; // Return the result set
    }

    public static function DataDetailPenialainAmal($id)
    {
        $data = DB::table('penilaian_aktifitas_amal_pbi')
        ->join('peserta_pbi', 'penilaian_aktifitas_amal_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
        ->leftjoin('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->leftjoin('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->leftjoin('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
        ->leftjoin('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'penilaian_aktifitas_amal_pbi.*',
        )
        ->whereNull('penilaian_aktifitas_amal_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('penilaian_aktifitas_amal_pbi.id_aktifitas_amal', $id)
        ->where('penilaian_aktifitas_amal_pbi.status_amal', 1)
        ->where('penilaian_aktifitas_amal_pbi.id_user', session('user')['id']) 
        ->first();
        return $data; // Return the result set
    }

    public static function PekanCount($tahun, $periode, $peserta) {
    
        $data = DB::table('penilaian_aktifitas_amal_pbi')
            ->join('peserta_pbi', 'penilaian_aktifitas_amal_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
            ->where('peserta_pbi.id_tahun_ajaran', $tahun)
            ->where('peserta_pbi.id_periode', $periode)
            ->where('peserta_pbi.id_peserta_pbi', $peserta)
            ->where('penilaian_aktifitas_amal_pbi.id_user',session('user')['id'])
            ->max('penilaian_aktifitas_amal_pbi.pekan_amal');
    
        $nextPekan = $data ? $data + 1 : 1;
    
        return $nextPekan;
    }  

    public static function PekanCountMandiri($tahun, $periode, $peserta, $guru, $pekan) {
    
        $data = DB::table('penilaian_aktifitas_amal_pbi')
            ->join('peserta_pbi', 'penilaian_aktifitas_amal_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
            ->where('peserta_pbi.id_tahun_ajaran', $tahun)
            ->where('peserta_pbi.id_periode', $periode)
            ->where('peserta_pbi.id_peserta_pbi', $peserta)
            ->where('penilaian_aktifitas_amal_pbi.id_user',$guru)
            ->where('penilaian_aktifitas_amal_pbi.pekan_amal',$pekan)
            ->exists(); 
    
        return $data;
    } 

    public static function NilaiAmalListAll($periode, $tahun,$siswa,$guru,$kelas)  {
        
        $data = DB::table('penilaian_aktifitas_amal_pbi')
        ->join('peserta_pbi', 'penilaian_aktifitas_amal_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
        ->leftjoin('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->leftjoin('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->leftjoin('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
        ->leftjoin('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'penilaian_aktifitas_amal_pbi.*',
        )
        ->whereNull('penilaian_aktifitas_amal_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('peserta_pbi.id_periode', $periode)
        ->where('peserta_pbi.id_tahun_ajaran', $tahun)
        ->where('peserta_pbi.id_siswa', $siswa)
        ->where('peserta_pbi.id_guru', $guru)
        ->where('peserta_pbi.id_kelas', $kelas)
        ->where('penilaian_aktifitas_amal_pbi.status_amal', 1)
        ->get();
        return $data; // Return the result set
    }

    public static function DataAmalaHome($peserta, $tahun)
    {
        // Start the query
        $query = DB::table('penilaian_aktifitas_amal_pbi')
            ->join('peserta_pbi', 'penilaian_aktifitas_amal_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
            ->select(
                'penilaian_aktifitas_amal_pbi.*',
            )
            ->where('peserta_pbi.id_tahun_ajaran', $tahun)
            ->where('peserta_pbi.id_siswa', $peserta)
            ->where('penilaian_aktifitas_amal_pbi.status_amal', 1)
            ->get();
        // Execute the query and return the results
        return $query;
    }

    public static function RataNilaiRapor($periode, $tahun, $siswa)
    {
        // Start the query
        $query = DB::table('penilaian_aktifitas_amal_pbi')
            ->join('peserta_pbi', 'penilaian_aktifitas_amal_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
            ->select(
                DB::raw('ROUND((SUM(sholat_wajib) + SUM(tilawah) + SUM(tahajud) + SUM(duha) + SUM(rawatib) + SUM(dzikri) + SUM(puasa) + SUM(infaq)) / (COUNT(*) * 8), 2) AS jumlah_amal')
            )
            ->where('peserta_pbi.id_periode', $periode)
            ->where('peserta_pbi.id_tahun_ajaran', $tahun)
            ->where('peserta_pbi.id_siswa', $siswa)
            ->where('penilaian_aktifitas_amal_pbi.status_amal', 1)
            ->first();
        
        // Return the result
        return $query;
    }

    public static function NilaiAmalListExt($periode, $tahun,$siswa,$kelas)  {
        
        $data = DB::table('penilaian_aktifitas_amal_pbi')
        ->join('peserta_pbi', 'penilaian_aktifitas_amal_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
        ->leftjoin('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->leftjoin('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->leftjoin('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
        ->leftjoin('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'penilaian_aktifitas_amal_pbi.*',
        )
        ->whereNull('penilaian_aktifitas_amal_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('peserta_pbi.id_periode', $periode)
        ->where('peserta_pbi.id_tahun_ajaran', $tahun)
        ->where('peserta_pbi.id_siswa', $siswa)
        ->where('peserta_pbi.id_kelas', $kelas)
        ->where('penilaian_aktifitas_amal_pbi.status_amal', 2)
        ->where('penilaian_aktifitas_amal_pbi.jenis_pengisian_amal', 'mandiri')
        ->where('penilaian_aktifitas_amal_pbi.id_user', session('user')['id']) 
        ->get();
        return $data; // Return the result set
    }

    
    
}
