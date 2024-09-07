<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RaporBpiModel extends Model
{
    use HasFactory;
    protected $table ="rapor_pbi";
    protected $primaryKey = 'id_rapor_pbi';
    public $incrementing = false; 
    protected $keyType = 'string'; 
    protected $fillable = [
    'id_rapor_pbi',
    'id_tahun_ajaran',
    'id_periode',
    'id_siswa',
    'id_kelas',
    'id_guru',
    'alquran',
    'aqidah',
    'ibadah',
    'hadits',
    'sirah',
    'tazkiyatun',
    'fikrul',
    'aqdh',
    'ibdh',
    'akhlak',
    'prbd',
    'aqr',
    'wwsn',
    'sholat_wajib',
    'tilawah',
    'tahajud',
    'duha',
    'rawatib',
    'dzikri',
    'puasa',
    'infaq',
    'id_user',
    'deleted_at'
    ];

    public static function DataPesertaRapor($tahun,$periode)  {
        
        $data = DB::table('rapor_pbi')
        ->join('siswa', 'rapor_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->join('kelas', 'rapor_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->join('guru', 'rapor_pbi.id_guru', '=', 'guru.id_guru')
        ->join('periode', 'rapor_pbi.id_periode', '=', 'periode.id_periode')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'rapor_pbi.*',
        )
        ->whereNull('rapor_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('rapor_pbi.id_tahun_ajaran', $tahun)
        ->where('rapor_pbi.id_periode', $periode)
        ->get();

        return $data; // Return the result set
    }

    public static function DataAjaxPesertaRapor($id,$peserta, $tahun,$jenjang,$periode)  {
        
        $data = DB::table('rapor_pbi')
        ->join('siswa', 'rapor_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->join('kelas', 'rapor_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->join('guru', 'rapor_pbi.id_guru', '=', 'guru.id_guru')
        ->join('periode', 'rapor_pbi.id_periode', '=', 'periode.id_periode')
        ->join('tahun_ajaran', 'rapor_pbi.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'rapor_pbi.*',
            'tahun_ajaran.*',
        )
        ->whereNull('rapor_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('rapor_pbi.id_rapor_pbi', $id)
        ->where('rapor_pbi.id_siswa', $peserta)
        ->where('rapor_pbi.id_tahun_ajaran', $tahun)
        ->where('rapor_pbi.id_periode', $periode)
        ->first();

        return $data; // Return the result set
    }

    public static function DataAjaxPenilaianPengembanganRapor($rapor,$peserta,$tahun,$periode)  {
        
        $data = DB::table('rapor_pbi')
        ->leftjoin('siswa', 'rapor_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->leftjoin('kelas', 'rapor_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->leftjoin('guru', 'rapor_pbi.id_guru', '=', 'guru.id_guru')
        ->leftjoin('periode', 'rapor_pbi.id_periode', '=', 'periode.id_periode')
        ->leftjoin('tahun_ajaran', 'rapor_pbi.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
        ->select(
            'siswa.*',
            'kelas.*',
            'guru.*',
            'periode.*',
            'rapor_pbi.*',
            'tahun_ajaran.*',
        )
        ->whereNull('rapor_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('rapor_pbi.id_rapor_pbi', $rapor)
        ->where('rapor_pbi.id_siswa', $peserta)
        ->where('rapor_pbi.id_tahun_ajaran', $tahun)
        ->where('rapor_pbi.id_periode', $periode)
        ->first();

        return $data; // Return the result set
    }

    public static function DataPesertaRaporPbiGuru($id_periode,$id_tahun_ajaran)
    {
        $data = DB::table('rapor_pbi')
            ->join('tahun_ajaran', 'rapor_pbi.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->join('periode', 'rapor_pbi.id_periode', '=', 'periode.id_periode')
            ->join('siswa', 'rapor_pbi.id_siswa', '=', 'siswa.id_siswa')
            ->join('kelas', 'rapor_pbi.id_kelas', '=', 'kelas.id_kelas')
            ->join('guru', 'rapor_pbi.id_guru', '=', 'guru.id_guru')
            ->select(
                'periode.*',
                'tahun_ajaran.*',
                'siswa.*',
                'kelas.*',
                'guru.*',
                'rapor_pbi.*'
            )
            ->where('periode.judul_periode', 'rapor')
            ->where('periode.id_periode', $id_periode)
            ->where('rapor_pbi.id_tahun_ajaran', $id_tahun_ajaran)
            ->where('rapor_pbi.id_guru', session('user')['id'])
            ->orderBy('rapor_pbi.created_at', 'DESC')
            ->get();
    
        return $data; // Return the result set
    }

    public static function dataExcel($idPeriode,$IdKelas)  {
        
        $data = DB::table('rapor_kegiatan')
        ->join('siswa', 'rapor_kegiatan.id_siswa', '=', 'siswa.id_siswa')
        ->join('kelas', 'rapor_kegiatan.id_kelas', '=', 'kelas.id_kelas')
        ->join('guru', 'rapor_kegiatan.id_guru', '=', 'guru.id_guru')
        ->join('periode', 'rapor_kegiatan.id_periode', '=', 'periode.id_periode')
        ->join('tahun_ajaran', 'rapor_kegiatan.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
        ->leftjoin('rapor_pengembangan_diri', 'rapor_kegiatan.id_rapor', '=', 'rapor_pengembangan_diri.id_rapor')
        ->select(
            'tahun_ajaran.nama_tahun_ajaran', //periode
            'siswa.nama_siswa', // nama
            'kelas.nama_kelas', // kelas
            'guru.nama_guru', //pembimbing
            'rapor_kegiatan.jenis_penilaian_kegiatan', //rapor
            'rapor_kegiatan.surah_baru', // hafalan baru
            'rapor_kegiatan.surah_lama', // hafalan lama
            'rapor_kegiatan.n_j_baru',  // nilai tajwid baru
            'rapor_kegiatan.n_f_baru', // Nilai Fasohah Baru
            'rapor_kegiatan.n_k_baru', // Nilai Kelancaran Baru
            'rapor_kegiatan.n_g_baru', // Nilai Gunnah Baru
            'rapor_kegiatan.n_m_baru', // Nilai Mad Baru
            'rapor_kegiatan.n_w_baru', // Nilai Waqof Baru
            'rapor_kegiatan.n_j_lama', // Nilai Tajwid Lama
            'rapor_kegiatan.n_f_lama', // Nilai Fasohah Lama
            'rapor_kegiatan.n_k_lama', // Nilai Kelancaran Lama
            'rapor_kegiatan.n_g_lama', // Nilai Gunnah Lama
            'rapor_kegiatan.n_m_lama', // Nilai Mad Lama
            'rapor_kegiatan.n_w_lama', // Nilai Waqof Lama
            'rapor_pengembangan_diri.n_k_p', // Nilai Keaktifan dan Kedisiplinan
            'rapor_pengembangan_diri.n_m_p', // Nilai Murajaah Hafalan Mandiri
            'rapor_pengembangan_diri.n_t_p', // Nilai Tilawah Al-Quran
            'rapor_pengembangan_diri.n_th_p', // Nilai Tahsin Al-Quran
            'rapor_pengembangan_diri.n_tf_p', // Nilai Tarjim / Tafhim Al-Quran
            'rapor_pengembangan_diri.n_jk_p', // Nilai Hasil Jumlah Khatam Al-Quran

        )
        ->whereNull('rapor_kegiatan.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('rapor_kegiatan.id_periode', $idPeriode)
        ->where('rapor_kegiatan.id_kelas', $IdKelas)
        ->get();

        return $data; // Return the result set
    }

}
