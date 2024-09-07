<br><br>
    <table cellpadding="0">
        <tr >
            <td style="height: 10px;text-align:center;" width="100%"><b>KARTU PENILAIAN PBI <br> TAHUN PELAJARAN {{ $peserta->nama_tahun_ajaran}}</b></td>
        </tr>
    </table>
<br><br>
<!-- identitas -->
 <div>
    <table cellpadding="0" >
        <tr>
            <th width="15%" style="height: 20px;";>Nama</th>
            <th width="60%" style="height: 20px;";>: <b> {{ ucwords($peserta->nama_siswa) }}</b></th>
        </tr>
        <tr>
            <th width="15%" style="height: 20px;";>Program</th>
            <th width="60%" style="height: 20px;";>: <b> PBI </b></th>
        </tr>
        <tr>
            <th width="15%" style="height: 20px;";>Kelas</th>
            <th width="60%" style="height: 20px;";>: <b> {{ $peserta->nama_kelas }}</b></th>
        </tr>
        <tr>
            <th width="15%" style="height: 20px;";>Periode</th>
            <th width="60%" style="height: 20px;";>: <b> {{ $peserta->nama_tahun_ajaran}}</b></th>
        </tr>
    </table>
 </div>
<div style="text-align: center; margin-top:0px;">
    <span><center><b>BIDANG STUDI</b></center></span><br>
    <table id="tb-item" cellpadding="2" style="border-collapse: collapse; width: 100%;">
        <tr style="background-color:#a9a9a9">
            <th width="13%" style="height: 40px; text-align:center; vertical-align: middle;" ><strong>KALI/PEKAN</strong></th>
            <th width="13%" style="height: 40px;text-align:center; vertical-align: middle;" ><strong>Al Qur'an</strong></th>
            <th width="13%" style="height: 20px; text-align:center"><strong>AQIDAH</strong></th>
            <th width="13%" style="height: 40px;text-align:center; vertical-align: middle;" ><strong>IBADAH</strong></th>
            <th width="13%" style="height: 40px;text-align:center; vertical-align: middle;" ><strong>HADITS</strong></th>
            <th width="13%" style="height: 40px;text-align:center; vertical-align: middle;" ><strong>SIRAH</strong></th>
            <th width="15%" style="height: 40px;text-align:center; vertical-align: middle;" ><strong>TAZKIYATUN NAFS</strong></th>
            <th width="13%" style="height: 40px;text-align:center; vertical-align: middle;" ><strong>FIKRUL ISALM</strong></th>
        </tr>
        <?php foreach ($nilai_bidang_studi as $key => $value){  ?>
        <tr>
            <td style="height: 20px; text-align:center; padding-top: 10px; padding-bottom: 10px;">PEKAN {{$value->pekan_bidang_studi}}</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->alquran}}</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->aqidah}}</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->ibadah}}</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->hadits}}</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->sirah}}</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->tazkiyatun}}</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->fikrul}}</td>
        </tr>
        <?php } ?>
    </table><br><br>
    <span><center><b>KARAKTER</b></center></span><br>
    <table id="tb-item" cellpadding="2" style="border-collapse: collapse; width: 100%;">
        <tr style="background-color:#a9a9a9">
            <th width="13%" style="height: 40px; text-align:center;" ><strong>No.</strong></th>
            <th width="15%" style="height: 40px;text-align:center;" ><strong>AQIDAH</strong></th>
            <th width="15%" style="height: 40px;text-align:center;" ><strong>IBADAH</strong></th>
            <th width="18%" style="height: 40px;text-align:center;" ><strong>KEPRIBADIAN</strong></th>
            <th width="15%" style="height: 40px;text-align:center;" ><strong>DISIPLIN</strong></th>
            <th width="15%" style="height: 40px;text-align:center;" ><strong>MAMPU</strong></th>
            <th width="15%" style="height: 40px;text-align:center;" ><strong>WAWASAN</strong></th>
        </tr>
        <?php foreach ($nilai_karakter as $key => $value){  ?>
        <tr>
            <td style="height: 20px; text-align:center; padding-top: 10px; padding-bottom: 10px;">PEKAN {{$value->pekan_karakter}}</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->aqdh}}</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->ibdh}}</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->akhlak}}</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->prbd}}</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->aqr}}</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->wwsn}}</td>
        </tr>
        <?php } ?>
    </table><br><br>
    <span><center><b>AKTIVITAS AMAL</b></center></span><br>
    <table id="tb-item" cellpadding="2" style="border-collapse: collapse; width: 100%;">
        <tr style="background-color:#a9a9a9">
            <th width="10%" style="height: 40px; text-align:center; vertical-align: middle;" ><strong>No.</strong></th>
            <th width="13%" style="height: 40px;text-align:center; vertical-align: middle;" ><strong>SHOLAT WAJIB</strong></th>
            <th width="11%" style="height: 20px; text-align:center"><strong>TILAWAH</strong></th>
            <th width="13%" style="height: 40px;text-align:center; vertical-align: middle;" ><strong>TAHAJJUD</strong></th>
            <th width="13%" style="height: 40px;text-align:center; vertical-align: middle;" ><strong>DUHA</strong></th>
            <th width="13%" style="height: 40px;text-align:center; vertical-align: middle;" ><strong>RAWATIB</strong></th>
            <th width="13%" style="height: 40px;text-align:center; vertical-align: middle;" ><strong>DZIKIR</strong></th>
            <th width="10%" style="height: 40px;text-align:center; vertical-align: middle;" ><strong>PUASA</strong></th>
            <th width="10%" style="height: 40px;text-align:center; vertical-align: middle;" ><strong>INFAQ</strong></th>
        </tr>
        <?php foreach ($nilai_amal as $key => $value){  ?>
        <tr>
            <td style="height: 20px; text-align:center; padding-top: 10px; padding-bottom: 10px;">PEKAN {{$value->pekan_amal}}</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->sholat_wajib}} KALI</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->tilawah}} KALI</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->tahajud}} KALI</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->duha}} KALI</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->rawatib}} KALI</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->dzikri}} KALI</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->puasa}} KALI</td>
            <td style="height: 20px;text-align:center; padding-top: 10px; padding-bottom: 10px;">{{ $value->infaq}} KALI</td>
        </tr>
        <?php } ?>
    </table>
    <br><br><br>
    <table cellpadding="2">
        <tr>
            <th style="width: 30%; height: 20px; text-align: center;">Mengetahui<br> Kepala Madrasah</th>
            <th style="width: 40%; height: 20px; text-align: center;"></th>
            <th style="width: 30%; height: 20px; text-align: center;">Pekanbaru,....,...................,20.....<br> Pembimbing, </th>
        </tr>
        <tr>
            <td colspan="3" style="height: 20px;">
                <br><br><br><br><br>
            </td>
        </tr>
        <tr>
            <th style="height: 20px; text-align: center;">______________________________</th>
            <th style="height: 20px; text-align: center;"></th>
            <th style="height: 20px; text-align: center;"><b>{{ strtoupper($peserta->nama_guru) }}</b></th>
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