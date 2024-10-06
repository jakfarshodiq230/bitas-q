<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Scopes\ExcludePasswordScope;


class PeriodeModel extends Model
{
    use HasFactory;
    protected $table ="periode";
    protected $primaryKey = 'id_periode';
    public $incrementing = false; 
    protected $keyType = 'string'; 
    protected $fillable = [
        'id_periode', 'id_tahun_ajaran', 'judul_periode', 'jenis_periode', 'jenis_kegiatan', 
        'id_penilaian_periode', 'tggl_akhir_periode', 'tggl_akhir_penilaian', 'tggl_periode',
        'tanggungjawab_periode', 'pesan_periode', 'status_periode', 'file_periode', 'id_user','deleted_at',
        'juz_periode', 'sesi_periode'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ExcludePasswordScope());
    }

    public static function DataAll($idPeriodeKegiatan = null)
    {
        $query = DB::table('periode')
            ->join('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->select('periode.*','tahun_ajaran.*') 
            ->whereNull('periode.deleted_at')
            ->where('periode.judul_periode', 'setoran');
        
        if ($idPeriodeKegiatan !== null) {
            $query->where('periode.id_periode', '!=', $idPeriodeKegiatan);
        }
    
        $data = $query->orderBy('periode.created_at', 'DESC')->get();
    
        return $data;
    }

    public static function DataPbi($idPeriode = null)
    {
        $query = DB::table('periode')
            ->join('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->select('periode.*', 'tahun_ajaran.*')
            ->whereNull('periode.deleted_at')
            ->where('periode.judul_periode', 'pbi');
    
        // Tambahkan kondisi jika idPeriode tidak null
        if ($idPeriode !== null) {
            $query->where('periode.id_periode', '!=', $idPeriode);
        }
    
        $data = $query->orderBy('periode.created_at', 'DESC')->get();
    
        return $data;
    }
    

    public static function DataRapor()
    {
        $data = DB::table('periode')
            ->join('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->select('periode.*','tahun_ajaran.*',) 
            ->orderBy('periode.created_at', 'DESC')
            ->whereNull('periode.deleted_at')
            ->where('periode.judul_periode', 'rapor')
            ->where('periode.jenis_periode', '!=','pbi')
            ->get();
        
        return $data;
    }

    public static function DataRaporPbi()
    {
        $data = DB::table('periode')
            ->join('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->select('periode.*','tahun_ajaran.*',) 
            ->orderBy('periode.created_at', 'DESC')
            ->whereNull('periode.deleted_at')
            ->where('judul_periode', 'rapor')
            ->where('jenis_periode', 'pbi')
            ->get();
        
        return $data;
    }

    public static function DataPesertaRaporPbi()
    {
        $data = DB::table('periode')
            ->leftJoin('rapor_pbi', 'periode.id_periode', '=', 'rapor_pbi.id_periode')
            ->leftJoin('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->select('periode.*', 'tahun_ajaran.*', 
                     DB::raw('COALESCE(COUNT(rapor_pbi.id_siswa), 0) as siswa_count'))
            ->whereNull('periode.deleted_at')
            ->where('judul_periode', 'rapor')
            ->where('jenis_periode', 'pbi')
            ->groupBy('periode.id_periode', 'tahun_ajaran.id_tahun_ajaran') // Group by unique identifiers
            ->orderBy('periode.created_at', 'DESC')
            ->get();
        return $data;
    }

    public static function DataSertifikat()
    {
        $data = DB::table('periode')
            ->join('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->select('periode.*','tahun_ajaran.*',) 
            ->orderBy('periode.created_at', 'DESC')
            ->whereNull('periode.deleted_at')
            ->where('judul_periode', 'sertifikasi')
            ->get();
        
        return $data;
    }

    public static function DataPesertaRapor()
    {
        $data = DB::table('periode')
            ->leftJoin('rapor_kegiatan', 'periode.id_periode', '=', 'rapor_kegiatan.id_periode')
            ->leftJoin('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->select('periode.*', 'tahun_ajaran.*', 
                     DB::raw('COALESCE(COUNT(rapor_kegiatan.id_siswa), 0) as siswa_count'))
            ->whereNull('periode.deleted_at')
            ->where('judul_periode', 'rapor')
            ->where('jenis_periode', '!=','pbi')
            ->groupBy('periode.id_periode', 'tahun_ajaran.id_tahun_ajaran') // Group by unique identifiers
            ->orderBy('periode.created_at', 'DESC')
            ->get();

        return $data;
    }

    public static function DataPesertaSertifikasi()
    {
        $data = DB::table('periode')
            ->leftJoin('peserta_sertifikasi', 'periode.id_periode', '=', 'peserta_sertifikasi.id_periode')
            ->leftJoin('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->select('periode.*', 'tahun_ajaran.*', 
                     DB::raw('COALESCE(COUNT(peserta_sertifikasi.id_siswa), 0) as siswa_count'))
            ->whereNull('periode.deleted_at')
            ->whereNull('peserta_sertifikasi.deleted_at')
            ->where('judul_periode', 'sertifikasi')
            ->groupBy('periode.id_periode', 'tahun_ajaran.id_tahun_ajaran') // Group by unique identifiers
            ->orderBy('periode.created_at', 'DESC')
            ->get();
    
        return $data;
    }


    public static function DataPeriodeRapor($tahun,$jenjang,$periode)
    {
        $data = DB::table('periode')
            ->Join('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->select('*')
            ->whereNull('periode.deleted_at')
            ->where('periode.id_periode',$periode)
            ->where('periode.id_tahun_ajaran',$tahun)
            ->where('periode.jenis_periode', $jenjang)
            ->first();
    
        return $data;
    }

    public static function PresentasePeriode()
    {
        $data = DB::table('periode')
            ->leftJoin('peserta_kegiatan', 'periode.id_periode', '=', 'peserta_kegiatan.id_periode')
            ->leftJoin('peserta_sertifikasi', 'periode.id_periode', '=', 'peserta_sertifikasi.id_periode')
            ->leftJoin('peserta_pbi', 'periode.id_periode', '=', 'peserta_pbi.id_periode')
            ->leftJoin('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->select(
                'periode.judul_periode',
                'periode.jenis_periode',
                'periode.juz_periode',
                'periode.jenis_kegiatan',
                'tahun_ajaran.nama_tahun_ajaran',
                DB::raw('COUNT(DISTINCT peserta_kegiatan.id_siswa) as jumlah_siswa_setoran'),
                DB::raw('COUNT(DISTINCT peserta_sertifikasi.id_siswa) as jumlah_siswa_sertifikasi'),
                DB::raw('COUNT(DISTINCT peserta_pbi.id_siswa) as jumlah_siswa_bpi'),
            )
            ->whereNull('periode.deleted_at')
            ->where('periode.judul_periode', '!=', 'rapor')
            ->groupBy(
                'periode.id_periode',
            )
            ->get();
            
        return $data;
    }

    public static function Dashboard()
    {
        $data = DB::table('periode')
            ->select('*')
            ->whereNull('periode.deleted_at')
            ->whereNotIn('periode.judul_periode', ['setoran', 'pbi'])
            ->where('periode.status_periode', '=', 1)
            ->orderBy('periode.tggl_akhir_penilaian', 'ASC')
            ->get();
            
        return $data;
    }

    public static function PeridoeMandiri()
    {
        $data = DB::table('periode')
            ->join('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->join('peserta_pbi', 'periode.id_periode', '=', 'peserta_pbi.id_periode')
            ->select('periode.*','tahun_ajaran.*','peserta_pbi.*') 
            ->whereNull('periode.deleted_at')
            ->where('judul_periode', 'pbi')
            ->where('status_periode', 1)
            ->where('peserta_pbi.id_siswa', session('user')['id'])
            ->first();
        
        return $data;
    }

    public static function NilaiaMandiriSiswa()
    {
        $data = DB::table('periode')
            ->join('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->join('peserta_pbi', 'periode.id_periode', '=', 'peserta_pbi.id_periode')
            ->join('penilaian_aktifitas_amal_pbi', 'peserta_pbi.id_peserta_pbi', '=', 'penilaian_aktifitas_amal_pbi.id_peserta_pbi')
            ->select('periode.*','tahun_ajaran.*','penilaian_aktifitas_amal_pbi.*') 
            ->whereNull('periode.deleted_at')
            ->where('judul_periode', 'pbi')
            ->where('status_periode', 1)
            ->where('penilaian_aktifitas_amal_pbi.jenis_pengisian_amal', 'mandiri')
            ->where('peserta_pbi.id_siswa', session('user')['id'])
            ->get();
        
        return $data;
    }
    
    
    
}
