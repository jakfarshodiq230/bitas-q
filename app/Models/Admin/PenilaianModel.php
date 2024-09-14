<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Scopes\ExcludePasswordScope;

class PenilaianModel extends Model
{
    use HasFactory;
    protected $table ="penilaian_kegiatan";
    protected $primaryKey = 'id_penilaian_kegiatan';
    public $incrementing = false; 
    protected $keyType = 'string';
    protected $fillable = [
        'id_penilaian_kegiatan', 'id_peserta_kegiatan', 'tanggal_penilaian_kegiatan', 'jenis_penilaian_kegiatan', 'surah_awal_penilaian_kegiatan', 'surah_akhir_penilaian_kegiatan', 'ayat_awal_penilaian_kegiatan', 'ayat_akhir_penilaian_kegiatan', 'nilai_tajwid_penilaian_kegiatan', 'nilai_fasohah_penilaian_kegiatan', 'nilai_kelancaran_penilaian_kegiatan', 'nilai_ghunnah_penilaian_kegiatan', 'nilai_mad_penilaian_tahsin', 'nilai_waqof_penilaian_tahsin', 'keterangan_penilaian_kegiatan', 'deleted_at', 'id_user'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ExcludePasswordScope());
    }

    public static function DataPenialainKegiatan($tahun,$periode,$siswa,$guru,$kelas)
    {
        $data = DB::table('penilaian_kegiatan')
            ->join('surah as surah_awal', 'penilaian_kegiatan.surah_awal_penilaian_kegiatan', '=', 'surah_awal.nomor')
            ->join('surah as surah_akhir', 'penilaian_kegiatan.surah_akhir_penilaian_kegiatan', '=', 'surah_akhir.nomor')
            ->join('peserta_kegiatan', 'penilaian_kegiatan.id_peserta_kegiatan', '=', 'peserta_kegiatan.id_peserta_kegiatan')
            ->leftjoin('periode', 'peserta_kegiatan.id_periode', '=', 'periode.id_periode')
            ->select(
                'penilaian_kegiatan.*',
                'peserta_kegiatan.*',
                'surah_awal.namaLatin as namaLatin_awal',
                'surah_akhir.namaLatin as namaLatin_akhir',
                'periode.status_periode'
            )
            ->whereNull('penilaian_kegiatan.deleted_at')
            ->where('peserta_kegiatan.id_tahun_ajaran', $tahun)
            ->where('peserta_kegiatan.id_periode', $periode)
            ->where('peserta_kegiatan.id_siswa', $siswa)
            ->where('peserta_kegiatan.id_guru', $guru)
            ->where('peserta_kegiatan.id_kelas', $kelas)
            ->orderBy('penilaian_kegiatan.created_at', 'DESC')
            ->get();
    
        return $data; // Return the result set
    }  
    
    public static function DataDetailPenialainKegiatan($id)
    {
        $data = DB::table('penilaian_kegiatan')
            ->join('peserta_kegiatan', 'penilaian_kegiatan.id_peserta_kegiatan', '=', 'peserta_kegiatan.id_peserta_kegiatan')
            ->join('siswa', 'peserta_kegiatan.id_siswa', '=', 'siswa.id_siswa')
            ->join('kelas', 'peserta_kegiatan.id_kelas', '=', 'kelas.id_kelas')
            ->join('tahun_ajaran', 'peserta_kegiatan.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->join('periode', 'peserta_kegiatan.id_periode', '=', 'periode.id_periode')
            ->select(
                'penilaian_kegiatan.*',
                'peserta_kegiatan.*',
                'siswa.*',
                'kelas.*',
                'periode.*',
                'tahun_ajaran.*',
            )
            ->whereNull('penilaian_kegiatan.deleted_at')
            ->where('penilaian_kegiatan.id_penilaian_kegiatan', $id)
            ->orderBy('penilaian_kegiatan.created_at', 'DESC')
            ->first();
    
        return $data; // Return the result set
    }
    
    public static function DataAjaxNilaiPenilaianKartu($peserta, $tahun, $periode) {
        return DB::table('penilaian_kegiatan')
            ->leftJoin('peserta_kegiatan', 'penilaian_kegiatan.id_peserta_kegiatan', '=', 'peserta_kegiatan.id_peserta_kegiatan')
            ->leftJoin('surah as surah_awal', 'penilaian_kegiatan.surah_awal_penilaian_kegiatan', '=', 'surah_awal.nomor')
            ->leftJoin('surah as surah_akhir', 'penilaian_kegiatan.surah_akhir_penilaian_kegiatan', '=', 'surah_akhir.nomor')
            ->select(
                'penilaian_kegiatan.*',
                'surah_awal.namaLatin as nama_surah_awal', 
                'surah_akhir.namaLatin as nama_surah_akhir'
            )
            ->whereNull('peserta_kegiatan.deleted_at')
            ->where([
                ['penilaian_kegiatan.id_peserta_kegiatan', $peserta],
                ['peserta_kegiatan.id_tahun_ajaran', $tahun],
                ['peserta_kegiatan.id_periode', $periode],
                ['peserta_kegiatan.id_guru', session('user')['id']]
            ])
            ->orderBy('penilaian_kegiatan.created_at', 'DESC')
            ->get();
    }
    
    

    public static function DataAjaxIdentitasPenilaianKartu($peserta, $tahun, $jenjang, $periode)
    {
        return DB::table('penilaian_kegiatan')
            ->join('peserta_kegiatan', 'penilaian_kegiatan.id_peserta_kegiatan', '=', 'peserta_kegiatan.id_peserta_kegiatan')
            ->join('siswa', 'peserta_kegiatan.id_siswa', '=', 'siswa.id_siswa')
            ->join('guru', 'peserta_kegiatan.id_guru', '=', 'guru.id_guru')
            ->join('kelas', 'peserta_kegiatan.id_kelas', '=', 'kelas.id_kelas')
            ->join('tahun_ajaran', 'peserta_kegiatan.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->join('periode', 'peserta_kegiatan.id_periode', '=', 'periode.id_periode')
            ->select(
                'penilaian_kegiatan.*',
                'peserta_kegiatan.*',
                'siswa.*',
                'kelas.*',
                'periode.*',
                'tahun_ajaran.*',
                'guru.*'
            )
            ->whereNull(['penilaian_kegiatan.deleted_at', 'siswa.deleted_at'])
            ->where([
                ['peserta_kegiatan.id_peserta_kegiatan', $peserta],
                ['peserta_kegiatan.id_tahun_ajaran', $tahun],
                ['periode.jenis_periode', $jenjang],
                ['peserta_kegiatan.id_periode', $periode],
                ['peserta_kegiatan.id_guru', session('user')['id']]
            ])
            ->first();
    }

    public static function DataAjaxDashbort($peserta, $tahun, $jenjang) {
        $query = DB::table('penilaian_kegiatan')
            ->leftJoin('peserta_kegiatan', 'penilaian_kegiatan.id_peserta_kegiatan', '=', 'peserta_kegiatan.id_peserta_kegiatan')
            ->leftJoin('surah as surah_awal', 'penilaian_kegiatan.surah_awal_penilaian_kegiatan', '=', 'surah_awal.nomor')
            ->leftJoin('surah as surah_akhir', 'penilaian_kegiatan.surah_akhir_penilaian_kegiatan', '=', 'surah_akhir.nomor')
            ->select(
                'penilaian_kegiatan.*',
                'surah_awal.namaLatin as nama_surah_awal', 
                'surah_akhir.namaLatin as nama_surah_akhir'
            )
            ->whereNull('penilaian_kegiatan.deleted_at')
            ->where('penilaian_kegiatan.jenis_penilaian_kegiatan', $jenjang)
            ->where([
                ['peserta_kegiatan.id_siswa', $peserta],
                ['peserta_kegiatan.id_tahun_ajaran', $tahun]
            ]);
    
        return $query->orderBy('penilaian_kegiatan.created_at', 'DESC')
                     ->get();
    }

    public static function dataExcel($idPeriode, $IdKelas, $idSiswa)  {
        
        $data = DB::table('peserta_kegiatan')
        ->join('siswa', 'peserta_kegiatan.id_siswa', '=', 'siswa.id_siswa')
        ->join('kelas', 'peserta_kegiatan.id_kelas', '=', 'kelas.id_kelas')
        ->join('guru', 'peserta_kegiatan.id_guru', '=', 'guru.id_guru')
        ->join('periode', 'peserta_kegiatan.id_periode', '=', 'periode.id_periode')
        ->join('tahun_ajaran', 'peserta_kegiatan.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
        ->leftjoin('penilaian_kegiatan', 'peserta_kegiatan.id_peserta_kegiatan', '=', 'penilaian_kegiatan.id_peserta_kegiatan')
        ->select(
            'tahun_ajaran.nama_tahun_ajaran', //periode
            'siswa.nama_siswa', // nama
            'kelas.nama_kelas', // kelas
            'guru.nama_guru', //pembimbing
            'penilaian_kegiatan.jenis_penilaian_kegiatan', //rapor
            'penilaian_kegiatan.surah_awal_penilaian_kegiatan', // hafalan baru
            'penilaian_kegiatan.ayat_awal_penilaian_kegiatan', // hafalan lama
            'penilaian_kegiatan.surah_akhir_penilaian_kegiatan',  // nilai tajwid baru
            'penilaian_kegiatan.ayat_akhir_penilaian_kegiatan', // Nilai Fasohah Baru
            'penilaian_kegiatan.nilai_tajwid_penilaian_kegiatan', // Nilai Kelancaran Baru
            'penilaian_kegiatan.nilai_fasohah_penilaian_kegiatan', // Nilai Gunnah Baru
            'penilaian_kegiatan.nilai_kelancaran_penilaian_kegiatan', // Nilai Mad Baru
            'penilaian_kegiatan.nilai_ghunnah_penilaian_kegiatan', // Nilai Waqof Baru
            'penilaian_kegiatan.nilai_mad_penilaian_tahsin', // Nilai Tajwid Lama
            'penilaian_kegiatan.nilai_waqof_penilaian_tahsin', // Nilai Fasohah Lama
            'penilaian_kegiatan.keterangan_penilaian_kegiatan', // Nilai Kelancaran Lama
            'penilaian_kegiatan.tanggal_penilaian_kegiatan', // Nilai Gunnah Lama

        )
        ->whereNull('peserta_kegiatan.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('peserta_kegiatan.id_periode', $idPeriode)
        ->where('peserta_kegiatan.id_kelas', $IdKelas)
        ->where('peserta_kegiatan.id_siswa', $idSiswa)
        ->get();

        return $data; // Return the result set
    }
    
    
    
    
}
