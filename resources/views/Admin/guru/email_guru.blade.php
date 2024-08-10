<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: helvetica;
        }

        .kop_surat {
            text-align: center;
            font-size: 14pt;
            text-decoration: underline;
            font-weight: bold;
            text-transform: uppercase;
        }

        .kalimat_isi,
        .kalimat_pembuka,
        .kalimat_penutup {
            text-align: justify;
            font-size: 12pt;
        }

        .kelulusan {
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
        }

        .nomor {
            margin-top: -1000px !important;
            text-align: center !important;
            font-size: 13pt;
            font-weight: bold;
        }

        .label {
            width: 35%;
            font-size: 10pt;
            text-align: left;
        }

        .colon {
            width: 5%;
            text-align: center;
        }

        .isi_label {
            width: 65%;
            font-size: 10pt;
        }


        .tandatangan {
            font-size: 12pt;
            text-align: right;
        }

        .namakepsek {
            font-size: 12pt;
            text-align: right;
        }

        .catatan {
            text-align: left;
            font-size: 8pt;
            font-style: italic;
            color: brown;
        }
    </style>
</head>

<body>
    <span class="kalimat_pembuka">Pendaftaran akun MY-TAHFIDZ anda sebagai berikut</span>
    <br><br>
    {{-- isi --}}
    <table>
        <tr>
            <th class="label">Nama</th>
            <td class="colon">:</td>
            <td class="isi_label">{{$data['nama_guru']}}</td>
        </tr>
        <tr>
            <th class="label">Email</th>
            <td class="colon">:</td>
            <td class="isi_label">{{$data['email_guru']}}</td>
        </tr>
        <tr>
            <th class="label">No. HP</th>
            <td class="colon">:</td>
            <td class="isi_label">{{$data['no_hp_guru']}}</td>
        </tr>
        <tr>
            <th class="label">Tempat/Tanggal Lahir</th>
            <td class="colon">:</td>
            <td class="isi_label">{{$data['tanggal_lahir_guru'].'/'.$data['tempat_lahir_guru']}}</td>
        </tr>
        <tr>
            <th class="label">Jenis Kelamin</th>
            <td class="colon">:</td>
            <td class="isi_label">{{$data['jenis_kelamin_guru']}}</td>
        </tr>
        <tr>
            <th class="label">Username</th>
            <td class="colon">:</td>
            <td class="isi_label">{{$data['email_guru']}}</td>
        </tr>
        <tr>
            <th class="label">Password</th>
            <td class="colon">:</td>
            <td class="isi_label">{{$data['password']}}</td>
        </tr>
        <tr>
            <th class="label">Tanggal Daftar</th>
            <td class="colon">:</td>
            <td class="isi_label">{{$data['tanggal_daftar']}}</td>
        </tr>
    </table>
    {{-- end isi --}}
    <br><br>
    <span class="kalimat_isi">Silahkan Gunakan Username dan Password yang sudah terdafatar</span>

</body>

</html>