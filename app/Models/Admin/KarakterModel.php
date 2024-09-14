<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Scopes\ExcludePasswordScope;


class KarakterModel extends Model
{
    use HasFactory;
    protected $table ="penilaian_karakter_pbi";
    protected $primaryKey = 'id_karakter';
    public $incrementing = false; 
    protected $keyType = 'string';
    protected $fillable = [
        'id_karakter', 'id_peserta_pbi', 'pekan_karakter', 'aqdh', 'ibdh', 'akhlak', 'prbd', 'aqr', 'wwsn', 'kwta', 'perkemahan', 'mbit', 'tanggal_penilaian_karakter', 'ktr_karakter', 'status_karakter', 'id_user','deleted_at'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ExcludePasswordScope());
    }

    public static function NilaiKarakter($periode, $tahun)  {
        
        $data = DB::table('penilaian_karakter_pbi')
        ->join('peserta_pbi', 'penilaian_karakter_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
        ->leftjoin('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->leftjoin('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->leftjoin('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
        ->leftjoin('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'penilaian_karakter_pbi.*',
        )
        ->whereNull('penilaian_karakter_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('peserta_pbi.id_periode', $periode)
        ->where('peserta_pbi.id_tahun_ajaran', $tahun)
        ->where('penilaian_karakter_pbi.status_karakter', 0)
        ->where('penilaian_karakter_pbi.id_user', session('user')['id']) 
        ->get();
        return $data; // Return the result set
    }

    public static function NilaiKarakterList($periode, $tahun, $siswa,$kelas)  {
        
        $data = DB::table('penilaian_karakter_pbi')
        ->join('peserta_pbi', 'penilaian_karakter_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
        ->leftjoin('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->leftjoin('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->leftjoin('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
        ->leftjoin('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'penilaian_karakter_pbi.*',
        )
        ->whereNull('penilaian_karakter_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('peserta_pbi.id_periode', $periode)
        ->where('peserta_pbi.id_tahun_ajaran', $tahun)
        ->where('peserta_pbi.id_siswa', $siswa)
        ->where('peserta_pbi.id_kelas', $kelas)
        ->where('penilaian_karakter_pbi.status_karakter', 1)
        ->where('penilaian_karakter_pbi.id_user', session('user')['id']) 
        ->get();
        return $data; // Return the result set
    }

    public static function DataDetailPenialainKarakter($id)  {
        
        $data = DB::table('penilaian_karakter_pbi')
        ->join('peserta_pbi', 'penilaian_karakter_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
        ->leftjoin('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->leftjoin('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->leftjoin('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
        ->leftjoin('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'penilaian_karakter_pbi.*',
        )
        ->whereNull('penilaian_karakter_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('penilaian_karakter_pbi.id_karakter', $id)
        ->where('penilaian_karakter_pbi.status_karakter', 1)
        ->where('penilaian_karakter_pbi.id_user', session('user')['id']) 
        ->first();
        return $data; // Return the result set
    }

    public static function PekanCount($tahun, $periode, $peserta) {
        
        $data = DB::table('penilaian_karakter_pbi')
            ->join('peserta_pbi', 'penilaian_karakter_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
            ->where('peserta_pbi.id_tahun_ajaran', $tahun)
            ->where('peserta_pbi.id_periode', $periode)
            ->where('peserta_pbi.id_peserta_pbi', $peserta)
            ->where('penilaian_karakter_pbi.id_user', session('user')['id'])
            ->max('penilaian_karakter_pbi.pekan_karakter');
    
        $nextPekan = $data ? $data + 1 : 1;
    
        return $nextPekan;
    }

    public static function NilaiKarakterListAll($periode, $tahun, $siswa,$guru,$kelas)  {
        
        $data = DB::table('penilaian_karakter_pbi')
        ->join('peserta_pbi', 'penilaian_karakter_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
        ->leftjoin('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->leftjoin('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->leftjoin('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
        ->leftjoin('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'penilaian_karakter_pbi.*',
        )
        ->whereNull('penilaian_karakter_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('peserta_pbi.id_periode', $periode)
        ->where('peserta_pbi.id_tahun_ajaran', $tahun)
        ->where('peserta_pbi.id_siswa', $siswa)
        ->where('peserta_pbi.id_guru', $guru)
        ->where('peserta_pbi.id_kelas', $kelas)
        ->where('penilaian_karakter_pbi.status_karakter', 1)
        ->get();
        return $data; // Return the result set
    }

    
    public static function DataKarakterHome($peserta, $tahun)
    {
        // Start the query
        $query = DB::table('penilaian_karakter_pbi')
            ->join('peserta_pbi', 'penilaian_karakter_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
            ->select(
                'penilaian_karakter_pbi.*',
            )
            ->where('peserta_pbi.id_tahun_ajaran', $tahun)
            ->where('peserta_pbi.id_siswa', $peserta)
            ->get();
        // Execute the query and return the results
        return $query;
    }

    public static function RataNilaiRapor($periode, $tahun, $siswa)
    {
        // Start the query
        $query = DB::table('penilaian_karakter_pbi')
            ->join('peserta_pbi', 'penilaian_karakter_pbi.id_peserta_pbi', '=', 'peserta_pbi.id_peserta_pbi')
            ->select(
                DB::raw('ROUND((SUM(aqdh) + SUM(ibdh) + SUM(akhlak) + SUM(prbd) + SUM(aqr) + SUM(wwsn) + SUM(kwta) + SUM(perkemahan) + SUM(mbit)) / (COUNT(*) * 9), 2) AS jumlah_karakter')
            )
            ->where('peserta_pbi.id_periode', $periode)
            ->where('peserta_pbi.id_tahun_ajaran', $tahun)
            ->where('peserta_pbi.id_siswa', $siswa)
            ->where('penilaian_karakter_pbi.status_karakter', 1)
            ->first();
        
        return $query;
    }
    
    
}
