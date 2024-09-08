
<?php
if (!function_exists('getRating')) {
    function getRating($rata_baru) {
        if ($rata_baru >= 96 && $rata_baru <= 100) {
            return "Sangat Baik";
        } elseif ($rata_baru >= 86 && $rata_baru <= 95) {
            return "Baik";
        } elseif ($rata_baru >= 80 && $rata_baru <= 85) {
            return "Cukup";
        } else {
            return "Kurang";
        }
    }
}
if (!function_exists('getAmal')) {
    function getAmal($rata_baru) {
        if ($rata_baru == null) {
            return "Belum Dinilai";
        }
        if($rata_baru >= 20 && $rata_baru <= 100){
            return "Sangat Baik";
        }else if($rata_baru >= 11 && $rata_baru <=20){
            return "Baik";
        }else if($rata_baru >= 1 && $rata_baru <= 10){
            return "Cukup";
        }else {
            return "Kurang";
        }
    }
}


?>
<br><br>
    <table cellpadding="0">
        <tr >
            <td style="height: 10px;text-align:center;" width="100%"><b>LAPORAN HASIL BELAJAR BINA PRIBADI ISLAM (BPI) <br> TAHUN PELAJARAN {{ $nilai->nama_tahun_ajaran}}</b></td>
        </tr>
    </table>
<br><br>
<!-- identitas -->
<table cellpadding="2" >
    <tr>
        <th width="15%">Nama</th>
        <th width="50%">: <b> {{ strtoupper($nilai->nama_siswa) }}</b></th>
        <th width="10%">Semester</th>
        <th width="40%">: <b> {{ strtoupper($nilai->jenis_kegiatan)}}</b></th>
    </tr>
    <tr>
        <th width="15%">Kelas/Program</th>
        <th width="50%">: <b> {{ strtoupper($nilai->nama_kelas).' / BELAJAR BINA PRIBADI ISLAM (BPI)' }}</b></th>
        <th width="10%">Periode</th>
        <th width="40%">: <b> {{ strtoupper($nilai->nama_tahun_ajaran)}}</b></th>
    </tr>
</table>
<br>
<!-- end tabel -->
<div style="text-align: center;">
    <table id="tb-item" cellpadding="2">
        <tr style="background-color:#a9a9a9">
            <th width="7%" style="height: 20px; text-align:center" rowspan="2"><strong>No.</strong></th>
            <th width="57%" style="height: 20px;text-align:center" rowspan="2"><strong>Bidang Studi</strong></th>
            <th colspan="2" width="35%" style="height: 20px; text-align:center"><strong>Nilai Kognitif</strong></th>
        </tr>
        <tr style="background-color:#a9a9a9">
            <td style="height: 20px; text-align:center">Angka</td>
            <td style="height: 20px; text-align:center">Prediket</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center">01</td>
            <td style="height: 20px;text-align:lefth">Al Qur'an</td>
            <td style="height: 20px; text-align:center">{{ $nilai->alquran}}</td>
            <td style="height: 20px;text-align:center">{{ getRating($nilai->alquran)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center">02</td>
            <td style="height: 20px;text-align:lefth">Aqidah</td>
            <td style="height: 20px; text-align:center">{{ $nilai->aqidah}}</td>
            <td style="height: 20px;text-align:center">{{ getRating($nilai->aqidah)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center">03</td>
            <td style="height: 20px;text-align:lefth">Ibadah</td>
            <td style="height: 20px; text-align:center">{{ $nilai->ibadah}}</td>
            <td style="height: 20px;text-align:center">{{ getRating($nilai->ibadah)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center">04</td>
            <td style="height: 20px;text-align:lefth">Tazkiyatun Nafs</td>
            <td style="height: 20px; text-align:center">{{ $nilai->tazkiyatun}}</td>
            <td style="height: 20px;text-align:center">{{ getRating($nilai->tazkiyatun)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center">05</td>
            <td style="height: 20px;text-align:lefth">Hadits</td>
            <td style="height: 20px; text-align:center">{{ $nilai->hadits}}</td>
            <td style="height: 20px;text-align:center">{{ getRating($nilai->hadits)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center">06</td>
            <td style="height: 20px;text-align:lefth">Sirah</td>
            <td style="height: 20px; text-align:center">{{ $nilai->sirah}}</td>
            <td style="height: 20px;text-align:center">{{ getRating($nilai->sirah)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center">07</td>
            <td style="height: 20px;text-align:lefth">Fikrul Islam</td>
            <td style="height: 20px; text-align:center">{{ $nilai->fikrul}}</td>
            <td style="height: 20px;text-align:center">{{ getRating($nilai->fikrul)}}</td>
        </tr>
        <tr style="border:1px solid #000">
            <?php
                $rata = ($nilai->alquran+$nilai->aqidah+$nilai->ibadah+$nilai->tazkiyatun+$nilai->hadits+$nilai->sirah+$nilai->fikrul)/7;
            ?>
            <td colspan="2" style="height: 20px; text-align:center"><strong>Nilai Rata-Rata</strong></td>
            <td style="height: 20px;text-align:center"><b>{{ floor($rata)}}</b></td>
            <td style="height: 20px;text-align:center"><b>{{ getRating($rata)}}</b></td>
        </tr>
    </table>
    <br><br>
    <table id="tb-item" cellpadding="2">
        <tr style="background-color:#a9a9a9">
            <th width="7%" style="height: 20px; text-align:center"><strong>No.</strong></th>
            <th width="57%" style="height: 20px;text-align:center" ><strong>Karakter</strong></th>
            <th width="35%" style="height: 20px; text-align:center"><strong>Nilai Afektif dan Psikomotorik</strong></th>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center" width="7%">01</td>
            <td style="height: 20px;text-align:lefth" width="57%">Aqidah yang lurus</td>
            <td style="height: 20px; text-align:center">{{ getRating($nilai->aqdh)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center" width="7%">02</td>
            <td style="height: 20px;text-align:lefth" width="57%">Ibadah yang benar</td>
            <td style="height: 20px; text-align:center">{{ getRating($nilai->ibdh)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center" width="7%">03</td>
            <td style="height: 20px;text-align:lefth" width="57%">Kepribadian yang matang dan berakhlak mulia</td>
            <td style="height: 20px; text-align:center">{{ getRating($nilai->akhlak)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center" width="7%">04</td>
            <td style="height: 20px;text-align:lefth" width="57%">Pribadi yang sungguh-sungguh, disiplin dan mampu mengendalikan diri</td>
            <td style="height: 20px; text-align:center">{{ getRating($nilai->prbd)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center" width="7%">05</td>
            <td style="height: 20px;text-align:lefth" width="57%">Mampu membaca, menghafal, dan memahami Al-Qur’an</td>
            <td style="height: 20px; text-align:center">{{ getRating($nilai->aqr)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center" width="7%">06</td>
            <td style="height: 20px;text-align:lefth" width="57%">Berwawasan luas</td>
            <td style="height: 20px; text-align:center">{{ getRating($nilai->wwsn)}}</td>
        </tr>
    </table>
    <br><br>
    <table id="tb-item" cellpadding="2">
        <tr style="background-color:#a9a9a9">
            <th width="7%" style="height: 20px; text-align:center"><strong>No.</strong></th>
            <th width="57%" style="height: 20px;text-align:center" ><strong>Aktivitas Amal</strong></th>
            <th width="35%" style="height: 20px; text-align:center"><strong>Rata-Rata</strong></th>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center" width="7%">01</td>
            <td style="height: 20px;text-align:lefth" width="57%">Shalat wajib 5 Waktu berjamaah (putra: di masjid) (tepat waktu untuk putri)</td>
            <td style="height: 20px; text-align:center">{{ getAmal($nilai->sholat_wajib)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center" width="7%">02</td>
            <td style="height: 20px;text-align:lefth" width="57%">Tilawah  Al-Qur'an</td>
            <td style="height: 20px; text-align:center">{{ getAmal($nilai->tilawah)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center" width="7%">03</td>
            <td style="height: 20px;text-align:lefth" width="57%">Shalat Tahajud/Qiyamul Lail</td>
            <td style="height: 20px; text-align:center">{{ getAmal($nilai->tahajud)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center" width="7%">04</td>
            <td style="height: 20px;text-align:lefth" width="57%">Shalat Dhuha</td>
            <td style="height: 20px; text-align:center">{{ getAmal($nilai->duha)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center" width="7%">05</td>
            <td style="height: 20px;text-align:lefth" width="57%">Shalat Rawatib</td>
            <td style="height: 20px; text-align:center">{{ getAmal($nilai->rawatib)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center" width="7%">06</td>
            <td style="height: 20px;text-align:lefth" width="57%">Dzikir Pagi/Sore</td>
            <td style="height: 20px; text-align:center">{{ getAmal($nilai->dzikri)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center" width="7%">07</td>
            <td style="height: 20px;text-align:lefth" width="57%">Puasa Sunah</td>
            <td style="height: 20px; text-align:center">{{ getAmal($nilai->puasa)}}</td>
        </tr>
        <tr>
            <td style="height: 20px; text-align:center" width="7%">08</td>
            <td style="height: 20px;text-align:lefth" width="57%">Infaq</td>
            <td style="height: 20px; text-align:center">{{ getAmal($nilai->infaq)}}</td>
        </tr>
    </table>
</div>

<div style="text-align: center;">
    <?php $tanggal_periode = isset($nilai->tggl_periode) ? strftime('%d %B %Y', strtotime($nilai->tggl_periode)) : ''; ?>
    <p style="text-align: right; margin-right: 5%;">
        Pekanbaru, {{ $tanggal_periode }}
    </p><br><br>

    <table cellpadding="2" style="width: 100%;">
        <tr>
            <th style="width: 33%; height: 20px; text-align: center;">
                Mengetahui<br> Orang Tua
            </th>
            <th style="width: 33%; height: 20px; text-align: center;">
                Mengetahui<br> Kepala Madrasah
            </th>
            <th style="width: 33%; height: 20px; text-align: center;">
                Wali Kelas
            </th>
        </tr>
        <tr>
            <td colspan="3" style="height: 60px;">
                <br><br><br><br><br>
            </td>
        </tr>
        <tr>
            <th style="height: 20px; text-align: center;">
                <b>{{ $nilai->orangtua_siswa}}</b>
            </th>
            <th style="height: 20px; text-align: center;">
                <b>{{ $nilai->tanggungjawab_periode}}</b>
            </th>
            <th style="height: 20px; text-align: center;">
                <b>{{ $nilai->nama_guru}}</b>
            </th>
        </tr>
    </table>
</div>



<style>
    p, span, table { font-size: 12px}
    table { width: 100%; border: 1px solid #dee2e6;  }
    table#tb-item tr th, table#tb-item tr td {
        border:1px solid #000
    }
    
</style>