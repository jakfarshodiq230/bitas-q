<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Scopes\ExcludePasswordScope;


class PesertaPbiModel extends Model
{
    use HasFactory;
    protected $table ="peserta_pbi";
    protected $primaryKey = 'id_peserta_pbi';
    public $incrementing = false; 
    protected $keyType = 'string';
    protected $fillable = [
        'id_peserta_pbi', 'id_tahun_ajaran', 'id_periode', 'id_siswa', 'id_kelas', 'id_guru', 'status_peserta_pbi', 'deleted_at', 'id_user'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ExcludePasswordScope());
    }

    public static function DataAllAdmin()
    {
        $data = DB::table('periode')
            ->join('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->leftJoin('peserta_pbi', 'periode.id_periode', '=', 'peserta_pbi.id_periode')
            ->select(
                'periode.id_periode',
                'periode.judul_periode',
                'periode.jenis_periode',
                'periode.status_periode',
                'tahun_ajaran.id_tahun_ajaran',
                'tahun_ajaran.nama_tahun_ajaran',
                'tahun_ajaran.status_tahun_ajaran',
                DB::raw('count(peserta_pbi.id_periode) as total_peserta_pbi')
            )
            ->whereNull('periode.deleted_at')
            ->whereNull('peserta_pbi.deleted_at')
            ->where('periode.judul_periode', 'pbi')
            ->groupBy(
                'periode.id_periode',
                'periode.judul_periode',
                'tahun_ajaran.id_tahun_ajaran',
                'tahun_ajaran.nama_tahun_ajaran',
                'tahun_ajaran.status_tahun_ajaran'
            )
            ->orderBy('periode.created_at', 'DESC')
            ->get();
    
        return $data; // Return the result set
    }

    public static function DataAll()
    {
        $data = DB::table('periode')
            ->join('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->leftJoin('peserta_pbi', 'periode.id_periode', '=', 'peserta_pbi.id_periode')
            ->select(
                'periode.id_periode',
                'periode.judul_periode',
                'periode.jenis_periode',
                'periode.status_periode',
                'tahun_ajaran.id_tahun_ajaran',
                'tahun_ajaran.nama_tahun_ajaran',
                'tahun_ajaran.status_tahun_ajaran',
                DB::raw('count(peserta_pbi.id_periode) as total_peserta_pbi')
            )
            ->whereNull('periode.deleted_at')
            ->whereNull('peserta_pbi.deleted_at')
            ->where('periode.judul_periode', 'pbi')
            ->where('peserta_pbi.id_guru', session('user')['id'])
            ->groupBy(
                'periode.id_periode',
                'periode.judul_periode',
                'tahun_ajaran.id_tahun_ajaran',
                'tahun_ajaran.nama_tahun_ajaran',
                'tahun_ajaran.status_tahun_ajaran'
            )
            ->orderBy('periode.created_at', 'DESC')
            ->get();
    
        return $data; // Return the result set
    }

    public static function DataPesertapbiAll($id_periode,$id_tahun_ajaran)
    {
        $data = DB::table('peserta_pbi')
            ->join('tahun_ajaran', 'peserta_pbi.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->join('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
            ->join('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
            ->join('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
            ->join('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
            ->select(
                'periode.*',
                'tahun_ajaran.*',
                'siswa.*',
                'kelas.*',
                'guru.*',
                'peserta_pbi.*',
                DB::raw('NULL as password')
            )
            ->whereNull('peserta_pbi.deleted_at')
            ->where('periode.judul_periode', 'pbi')
            ->where('periode.id_periode', $id_periode)
            ->where('tahun_ajaran.id_tahun_ajaran', $id_tahun_ajaran)
            ->orderBy('peserta_pbi.created_at', 'DESC')
            ->get();
    
        return $data; // Return the result set
    }

    public static function DataSiswaProfil($tahun,$periode,$siswa,$guru,$kelas)
    {
        $data = DB::table('peserta_pbi')
            ->join('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
            ->join('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
            ->join('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
            ->join('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
            ->join('tahun_ajaran', 'peserta_pbi.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->select(
                'siswa.id_siswa',
                'siswa.nama_siswa',
                'siswa.foto_siswa',
                'periode.jenis_periode',
                'periode.status_periode',
                'guru.nama_guru',
                'kelas.nama_kelas',
                'tahun_ajaran.nama_tahun_ajaran'
            )
            ->whereNull('peserta_pbi.deleted_at')
            ->where('tahun_ajaran.id_tahun_ajaran', $tahun)
            ->where('periode.id_periode', $periode)
            ->where('siswa.id_siswa', $siswa)
            ->where('guru.id_guru', $guru)
            ->where('kelas.id_kelas', $kelas)
            ->first();
    
        return $data; // Return the result set
    }

    public static function DataSiswaGuru($tahun,$periode,$guru)  {
        $data = DB::table('peserta_pbi')
        ->join('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->join('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->select(
            'siswa.id_siswa',
            'siswa.nama_siswa',
            'siswa.nisn_siswa',
            'kelas.id_kelas',
            'kelas.nama_kelas',
            'peserta_pbi.id_peserta_pbi',
        )
        ->whereNull('peserta_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('peserta_pbi.id_tahun_ajaran', $tahun)
        ->where('peserta_pbi.id_periode', $periode)
        ->where('peserta_pbi.id_guru', $guru)
        ->where('peserta_pbi.status_peserta_pbi', 1)
        ->get();
        return $data; // Return the result set
    }


    public static function DataAllGuru($guru)
    {
        $data = DB::table('periode')
            ->join('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->leftJoin('peserta_pbi', 'periode.id_periode', '=', 'peserta_pbi.id_periode')
            ->select(
                'periode.id_periode',
                'periode.judul_periode',
                'periode.jenis_periode',
                'periode.status_periode',
                'periode.sesi_periode',
                'tahun_ajaran.id_tahun_ajaran',
                'tahun_ajaran.nama_tahun_ajaran',
                'tahun_ajaran.status_tahun_ajaran',
                DB::raw('count(peserta_pbi.id_periode) as total_peserta_pbi')
            )
            ->whereNull('periode.deleted_at')
            ->whereNull('peserta_pbi.deleted_at')
            ->where('periode.judul_periode', 'pbi')
            ->where('peserta_pbi.id_guru', $guru)
            ->groupBy(
                'periode.id_periode',
                'periode.judul_periode',
                'tahun_ajaran.id_tahun_ajaran',
                'tahun_ajaran.nama_tahun_ajaran',
                'tahun_ajaran.status_tahun_ajaran'
            )
            ->orderBy('periode.created_at', 'DESC')
            ->get();
    
        return $data; // Return the result set
    }


    public static function DataDaftarPeserta($tahun, $jenjang, $periode, $selectedIds)
    {
        $data = DB::table('periode')
            ->join('tahun_ajaran', 'periode.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->join('peserta_pbi', 'periode.id_periode', '=', 'peserta_pbi.id_periode')
            ->join('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
            ->join('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
            ->join('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
            ->select(
                'periode.*',
                'tahun_ajaran.*',
                'siswa.*',
                'kelas.*',
                'guru.*',
                DB::raw('NULL as password')
            )
            ->whereNull('periode.deleted_at')
            ->whereNull('peserta_pbi.deleted_at')
            ->where('tahun_ajaran.id_tahun_ajaran', $tahun)
            ->where('periode.jenis_periode', $jenjang)
            ->where('peserta_pbi.id_guru', session('user')['id'])
            ->whereNotIn('siswa.id_siswa', $selectedIds) // Properly qualified column name
            ->orderBy('periode.created_at', 'DESC')
            ->get();

        return $data; // Return the result set
    }

    public static function DataDashbordGuru($tahun, $guru)
    {
        $query = DB::table('peserta_pbi')
            ->leftJoin('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
            ->select(
                'siswa.*',
                DB::raw('NULL as password')
            )
            ->where('peserta_pbi.id_tahun_ajaran', $tahun)
            ->groupBy(
                'siswa.id_siswa'
            )
            ->orderBy('siswa.nama_siswa', 'DESC');
    
        if ($guru !== null) {
            $query->where('peserta_pbi.id_guru', $guru);
        }
    
        $data = $query->get();
    
        return $data; // Return the result set
    }

    public static function PesertaExcel($idPeriode,$IdKelas)  {
        $data = DB::table('peserta_pbi')
        ->join('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
        ->join('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
        ->select(
            'siswa.id_siswa',
            'siswa.nama_siswa',
            'siswa.nisn_siswa',
            'kelas.id_kelas',
            'kelas.nama_kelas',
            'peserta_pbi.id_peserta_pbi',
        )
        ->whereNull('peserta_pbi.deleted_at')
        ->whereNull('siswa.deleted_at')
        ->where('peserta_pbi.id_kelas', $IdKelas)
        ->where('peserta_pbi.id_periode', $idPeriode)
        ->where('peserta_pbi.status_peserta_pbi', 1)
        ->get();
        return $data; // Return the result set
    }

    public static function DataPesertaPbiGuru($id_periode,$id_tahun_ajaran)
    {
        $data = DB::table('peserta_pbi')
            ->join('tahun_ajaran', 'peserta_pbi.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->join('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
            ->join('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
            ->join('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
            ->join('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
            ->select(
                'periode.*',
                'tahun_ajaran.*',
                'siswa.*',
                'kelas.*',
                'guru.*',
                'peserta_pbi.*',
                DB::raw('NULL as password')
            )
            ->whereNull('peserta_pbi.deleted_at')
            ->where('periode.judul_periode', 'pbi')
            ->where('periode.id_periode', $id_periode)
            ->where('tahun_ajaran.id_tahun_ajaran', $id_tahun_ajaran)
            ->where('peserta_pbi.id_guru', session('user')['id'])
            ->orderBy('peserta_pbi.created_at', 'DESC')
            ->get();
    
        return $data; // Return the result set
    }

    public static function DataPesertaPbiDetail($periode,$tahun,$siswa,$kelas)
    {
        $data = DB::table('peserta_pbi')
            ->join('tahun_ajaran', 'peserta_pbi.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->join('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
            ->join('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
            ->join('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
            ->join('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
            ->select(
                'periode.*',
                'tahun_ajaran.*',
                'siswa.*',
                'kelas.*',
                'guru.*',
                DB::raw('NULL as password')
            )
            ->whereNull('peserta_pbi.deleted_at')
            ->where('periode.judul_periode', 'pbi')
            ->where('peserta_pbi.id_periode', $periode)
            ->where('peserta_pbi.id_tahun_ajaran', $tahun)
            ->where('peserta_pbi.id_siswa', $siswa)
            ->where('peserta_pbi.id_kelas', $kelas)
            ->where('peserta_pbi.id_guru', session('user')['id'])
            ->orderBy('peserta_pbi.created_at', 'DESC')
            ->first();
    
        return $data; // Return the result set
    }

    public static function DataPesertaPbiDetailAll($periode,$tahun,$siswa,$guru,$kelas)
    {
        $data = DB::table('peserta_pbi')
            ->join('tahun_ajaran', 'peserta_pbi.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->join('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
            ->join('siswa', 'peserta_pbi.id_siswa', '=', 'siswa.id_siswa')
            ->join('kelas', 'peserta_pbi.id_kelas', '=', 'kelas.id_kelas')
            ->join('guru', 'peserta_pbi.id_guru', '=', 'guru.id_guru')
            ->select(
                'periode.*',
                'tahun_ajaran.*',
                'siswa.*',
                'kelas.*',
                'guru.*',
                DB::raw('NULL as password')
            )
            ->whereNull('peserta_pbi.deleted_at')
            ->where('periode.judul_periode', 'pbi')
            ->where('peserta_pbi.id_periode', $periode)
            ->where('peserta_pbi.id_tahun_ajaran', $tahun)
            ->where('peserta_pbi.id_siswa', $siswa)
            ->where('peserta_pbi.id_guru', $guru)
            ->where('peserta_pbi.id_kelas', $kelas)
            ->orderBy('peserta_pbi.created_at', 'DESC')
            ->first();
    
        return $data; // Return the result set
    }

    public static function DataPesertaRapor($id_tahun_ajaran, $jenisRapor, $tglMulai, $tglAkhir)
    {
        $queryBase = DB::table('peserta_pbi')
            ->join('tahun_ajaran', 'peserta_pbi.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->join('periode', 'peserta_pbi.id_periode', '=', 'periode.id_periode')
            ->join('penilaian_aktifitas_amal_pbi', 'peserta_pbi.id_peserta_pbi', '=', 'penilaian_aktifitas_amal_pbi.id_peserta_pbi')
            ->join('penilaian_bidang_studi_pbi', 'peserta_pbi.id_peserta_pbi', '=', 'penilaian_bidang_studi_pbi.id_peserta_pbi')
            ->join('penilaian_karakter_pbi', 'peserta_pbi.id_peserta_pbi', '=', 'penilaian_karakter_pbi.id_peserta_pbi')
            ->select(
                'peserta_pbi.*'
            )
            ->whereNull('peserta_pbi.deleted_at')
            ->where('periode.judul_periode', 'pbi')
            ->where('periode.jenis_periode', $jenisRapor)
            ->where('tahun_ajaran.id_tahun_ajaran', $id_tahun_ajaran)
            ->where('peserta_pbi.status_peserta_pbi', 1)
            ->whereBetween('penilaian_aktifitas_amal_pbi.tanggal_penilaian_amal', [$tglMulai, $tglAkhir])
            ->whereBetween('penilaian_bidang_studi_pbi.tanggal_penilaian_bidang_studi', [$tglMulai, $tglAkhir])
            ->whereBetween('penilaian_karakter_pbi.tanggal_penilaian_karakter', [$tglMulai, $tglAkhir]);
    
        $queryKeterangan = clone $queryBase;
        $queryKeterangan->addSelect(
            // nilai penilaian_aktifitas_amal_pbi
            DB::raw('ROUND((SUM(penilaian_aktifitas_amal_pbi.sholat_wajib)) / (COUNT(penilaian_aktifitas_amal_pbi.sholat_wajib)), 2) AS sholat_wajib'),
            DB::raw('ROUND((SUM(penilaian_aktifitas_amal_pbi.tilawah)) / (COUNT(penilaian_aktifitas_amal_pbi.tilawah)), 2) AS tilawah'),
            DB::raw('ROUND((SUM(penilaian_aktifitas_amal_pbi.tahajud)) / (COUNT(penilaian_aktifitas_amal_pbi.tahajud)), 2) AS tahajud'),
            DB::raw('ROUND((SUM(penilaian_aktifitas_amal_pbi.duha)) / (COUNT(penilaian_aktifitas_amal_pbi.duha)), 2) AS duha'),
            DB::raw('ROUND((SUM(penilaian_aktifitas_amal_pbi.rawatib)) / (COUNT(penilaian_aktifitas_amal_pbi.rawatib)), 2) AS rawatib'),
            DB::raw('ROUND((SUM(penilaian_aktifitas_amal_pbi.dzikri)) / (COUNT(penilaian_aktifitas_amal_pbi.dzikri)), 2) AS dzikri'),
            DB::raw('ROUND((SUM(penilaian_aktifitas_amal_pbi.puasa)) / (COUNT(penilaian_aktifitas_amal_pbi.puasa)), 2) AS puasa'),
            DB::raw('ROUND((SUM(penilaian_aktifitas_amal_pbi.infaq)) / (COUNT(penilaian_aktifitas_amal_pbi.infaq)), 2) AS infaq'),
    
            // nilai penilaian_bidang_studi_pbi
            DB::raw('ROUND((SUM(penilaian_bidang_studi_pbi.alquran)) / (COUNT(penilaian_bidang_studi_pbi.alquran)), 2) AS alquran'),
            DB::raw('ROUND((SUM(penilaian_bidang_studi_pbi.aqidah)) / (COUNT(penilaian_bidang_studi_pbi.aqidah)), 2) AS aqidah'),
            DB::raw('ROUND((SUM(penilaian_bidang_studi_pbi.ibadah)) / (COUNT(penilaian_bidang_studi_pbi.ibadah)), 2) AS ibadah'),
            DB::raw('ROUND((SUM(penilaian_bidang_studi_pbi.hadits)) / (COUNT(penilaian_bidang_studi_pbi.hadits)), 2) AS hadits'),
            DB::raw('ROUND((SUM(penilaian_bidang_studi_pbi.sirah)) / (COUNT(penilaian_bidang_studi_pbi.sirah)), 2) AS sirah'),
            DB::raw('ROUND((SUM(penilaian_bidang_studi_pbi.tazkiyatun)) / (COUNT(penilaian_bidang_studi_pbi.tazkiyatun)), 2) AS tazkiyatun'),
            DB::raw('ROUND((SUM(penilaian_bidang_studi_pbi.fikrul)) / (COUNT(penilaian_bidang_studi_pbi.fikrul)), 2) AS fikrul'),
    
            // nilai penilaian_karakter_pbi
            DB::raw('ROUND((SUM(penilaian_karakter_pbi.aqdh)) / (COUNT(penilaian_karakter_pbi.aqdh)), 2) AS aqdh'),
            DB::raw('ROUND((SUM(penilaian_karakter_pbi.ibdh)) / (COUNT(penilaian_karakter_pbi.ibdh)), 2) AS ibdh'),
            DB::raw('ROUND((SUM(penilaian_karakter_pbi.akhlak)) / (COUNT(penilaian_karakter_pbi.akhlak)), 2) AS akhlak'),
            DB::raw('ROUND((SUM(penilaian_karakter_pbi.prbd)) / (COUNT(penilaian_karakter_pbi.prbd)), 2) AS prbd'),
            DB::raw('ROUND((SUM(penilaian_karakter_pbi.aqr)) / (COUNT(penilaian_karakter_pbi.aqr)), 2) AS aqr'),
            DB::raw('ROUND((SUM(penilaian_karakter_pbi.wwsn)) / (COUNT(penilaian_karakter_pbi.wwsn)), 2) AS wwsn'),
            DB::raw('ROUND((SUM(penilaian_karakter_pbi.kwta)) / (COUNT(penilaian_karakter_pbi.kwta)), 2) AS kwta'),
            DB::raw('ROUND((SUM(penilaian_karakter_pbi.perkemahan)) / (COUNT(penilaian_karakter_pbi.perkemahan)), 2) AS perkemahan'),
            DB::raw('ROUND((SUM(penilaian_karakter_pbi.mbit)) / (COUNT(penilaian_karakter_pbi.mbit)), 2) AS mbit'),
            DB::raw('ROUND((SUM(penilaian_karakter_pbi.mbit)) / NULLIF(COUNT(penilaian_karakter_pbi.mbit), 0), 2) AS jumlah_amal')
        )
        ->groupBy('peserta_pbi.id_peserta_pbi', 'periode.id_periode', 'tahun_ajaran.id_tahun_ajaran');
    
        $dataKeterangan = $queryKeterangan->get();
    
        return $dataKeterangan;
    }
    

    public static function PesrtaStatistikPerkembanganPbiGuru()
    {
        $data = DB::table('rapor_pbi')
            ->join('siswa', 'rapor_pbi.id_siswa', '=', 'siswa.id_siswa')
            ->select(
                'siswa.nama_siswa',
                'rapor_pbi.id_siswa',
            )
            ->where('rapor_pbi.id_guru', session('user')['id'])
            ->groupBy('rapor_pbi.id_siswa')
            ->get();
    
        return $data; // Return the result set
    }

   
    
}
