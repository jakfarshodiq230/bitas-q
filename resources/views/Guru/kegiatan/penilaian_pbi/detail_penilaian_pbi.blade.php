@extends('Guru.layout')
@section('content')
    <style>
        .border-navy {
            border: 2px solid navy;
            /* Adjust the border width as needed */
            border-radius: 5px;
            /* Optional: Adjust the border radius as needed */
        }

        .profile {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .profile-item {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 10px;
        }

        .profile-item span.label {
            font-weight: bold;
            margin-right: 10px;
        }

        .profile-item span.separator {
            margin-right: 10px;
        }

        .profile-item span.value {
            margin-left: 10px;
        }
        .parent-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .parent-container canvas {
            max-width: 100%;
            max-height: 100%;
        }

    </style>
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title" id="judul_header">
                    DETAIL PENILAIAN PESERTA {{ strtoupper($judul_3) }}
                </h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row border-navy">
                                <div class="col-md-4 profile">
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Tahun Ajaran</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="tahun_ajaran" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Kegiatan</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="kegiatan" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Pembimbing</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="pembimbing" style="flex: 1;">-</span>
                                    </div>
                                </div>
                                <div class="col-md-4 profile">
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Nama</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="nama" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Kelas</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="kelas" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Kali/Pekan</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="kali_pekan" style="flex: 1;">-</span>
                                    </div>
                                </div>
                                <div class="col-md-4 profile">
                                    <div class="text-center">
                                        <img alt="Peserta" id="avatarImg" src=""
                                            class="rounded-circle img-responsive" width="100" height="100" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- grafik penilaian -->
                    <div class="card ">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="card ">
                                        <div class="card-header">
                                            <h5 class="card-title text-center">BIDANG STUDI</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="parent-container">
                                                <canvas id="chartjs-bidang_studi"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title text-center">KARAKTER</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="parent-container">
                                                <canvas id="chartjs-karakter"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title text-center">AKTIVITAS AMAL</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="parent-container">
                                                <canvas id="chartjs-amal"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- bidang studi --}}
                    <div class="card" id="bidang_studi">
                        <div class="card-body">
                            <table id="datatables-ajax-bidang_studi" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>KALI/PEKAN</th>
                                        <th>AL-QUR'AN</th>
                                        <th>AQIDAH</th>
                                        <th>TAZ</th>
                                        <th>IBADAH</th>
                                        <th>HADITS</th>
                                        <th>SIRAH</th>
                                        <th>FIKRUL ISLAM</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>KALI/PEKAN</th>
                                        <th>AL-QUR'AN</th>
                                        <th>AQIDAH</th>
                                        <th>TAZ</th>
                                        <th>IBADAH</th>
                                        <th>HADITS</th>
                                        <th>SIRAH</th>
                                        <th>FIKRUL ISLAM</th>
                                        <th>ACTION</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    {{-- Karakter --}}
                    <div class="card" id="karakter">
                        <div class="card-body">
                            <table id="datatables-ajax-karakter" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>KALI/PEKAN</th>
                                        <th>AQDH</th>
                                        <th>IBDH</th>
                                        <th>AKHLK</th>
                                        <th>PRBD</th>
                                        <th>AQR</th>
                                        <th>WWSN</th>
                                        <th>KWTA</th>
                                        <th>PERKEMAHAN</th>
                                        <th>MBIT</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>KALI/PEKAN</th>
                                        <th>AQDH</th>
                                        <th>IBDH</th>
                                        <th>AKHLK</th>
                                        <th>PRBD</th>
                                        <th>AQR</th>
                                        <th>WWSN</th>
                                        <th>KWTA</th>
                                        <th>PERKEMAHAN</th>
                                        <th>MBIT</th>
                                        <th>ACTION</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    {{-- Aktivitas Amal --}}
                    <div class="card" id="aktivitas_amal">
                        <div class="card-body">
                            <table id="datatables-ajax-aktivitas_amal" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>KALI/PEKAN</th>
                                        <th>SHOLAT WAJIB</th>
                                        <th>TILAWAH</th>
                                        <th>TAHAJJUD</th>
                                        <th>DUHA</th>
                                        <th>RAWATIB</th>
                                        <th>DZIKIR</th>
                                        <th>PUASA</th>
                                        <th>INFAQ</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>KALI/PEKAN</th>
                                        <th>SHOLAT WAJIB</th>
                                        <th>TILAWAH</th>
                                        <th>TAHAJJUD</th>
                                        <th>DUHA</th>
                                        <th>RAWATIB</th>
                                        <th>DZIKIR</th>
                                        <th>PUASA</th>
                                        <th>INFAQ</th>
                                        <th>ACTION</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    
                    {{-- add --}}
                    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-hidden="true"
                        data-bs-keyboard="false" data-bs-backdrop="static">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form method="POST" id="dataForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">Edit Harga</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body m-3">
                                        <div class="row">
                                            <div class="col-6 col-lg-6">
                                                <div class="mb-3">
                                                    <label>Tahun Ajaran</label>
                                                    <input type="text" name="tahun_ajaran" id="tahun_ajaran"
                                                        class="form-control" placeholder="id_tahun_ajaran"
                                                        value="" readonly>
                                                    <div id="tahun_ajaran-error" class="invalid-feedback"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Siswa</label>
                                                    <input type="text" name="siswa" id="siswa"
                                                        class="form-control" placeholder="id_tahun_ajaran"
                                                        value="" readonly>
                                                    <div id="siswa-error" class="invalid-feedback"></div>
                                                </div>
                                               
                                                <!-- keteranga bdang studi -->
                                                 <div id="form_bidang_studi">
                                                    <div class="mb-3">
                                                        <label>Al-Qur'an</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="bidang_studi_alquran" id="bidang_studi_alquran" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_bidang_studi_alquran\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="bidang_studi_alquran-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Aqidah</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="bidang_studi_aqidah" id="bidang_studi_aqidah" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_bidang_studi_aqidah\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="bidang_studi_aqidah-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Ibadah</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="bidang_studi_ibadah" id="bidang_studi_ibadah" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_bidang_studi_ibadah\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="bidang_studi_ibadah-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Hadits</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="bidang_studi_hadits" id="bidang_studi_hadits" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_bidang_studi_hadits\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="bidang_studi_hadits-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Sirah</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="bidang_studi_sirah" id="bidang_studi_sirah" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_bidang_studi_sirah\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="bidang_studi_sirah-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Tazkiyatun Nafs</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="bidang_studi_tazkiyatun" id="bidang_studi_tazkiyatun" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_bidang_studi_tazkiyatun\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="bidang_studi_tazkiyatun-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Fikrul Islam</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="bidang_studi_fikrul" id="bidang_studi_fikrul" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_bidang_studi_fikrul\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="bidang_studi_fikrul-error" class="invalid-feedback"></div>
                                                    </div>
                                                 </div>
                                                
                                                <!-- keterangan karakter -->
                                                <div id="form_karakter">
                                                    <div class="mb-3">
                                                        <label>Aqidah yang lurus</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="karakter_aqidah" id="karakter_aqidah" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_karakter_aqidah\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="karakter_aqidah-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Ibadah yang benar</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="karakter_ibadah" id="karakter_ibadah" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_karakter_ibadah\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="karakter_ibadah-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Kepribadian yang matang dan berakhlak mulia</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="karakter_kepribadian" id="karakter_kepribadian" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_karakter_kepribadian\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="karakter_kepribadian-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Pribadi yang sungguh-sungguh, disiplin dan mampu mengendalikan diri</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="karakter_pribadi" id="karakter_pribadi" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_karakter_pribadi\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="karakter_pribadi-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Mampu membaca, menghafal, dan memahami Al-Qur’an</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="karakter_mampu" id="karakter_mampu" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_karakter_mampu\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="karakter_mampu-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Berwawasan luas</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="karakter_wawasan" id="karakter_wawasan" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_karakter_wawasan\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="karakter_wawasan-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Karya Wisata/Tafakur Alam</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="kwta" id="kwta" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_kwta\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="kwta-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Perkemahan</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="perkemahan" id="perkemahan" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_perkemahan\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="perkemahan-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Malam Bina Iman dan Taqwa</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="mbit" id="mbit" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_mbit\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="mbit-error" class="invalid-feedback"></div>
                                                    </div>

                                                </div>

                                                <!-- keterangan aktivitas amal -->
                                                <div id="form_aktivitas_amal">
                                                    <div class="mb-3">
                                                        <label>Shalat wajib 5 Waktu berjamaah</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="aktivitas_amal_sholat_wajib" id="aktivitas_amal_sholat_wajib" data-bs-toggle="select2"
                                                            required>
                                                            <option>PILIH</option>
                                                            @for ($i = 1; $i <= 100; $i++)
                                                            <option value="{{$i}}">{{$i." KALI"}}</option>
                                                            @endfor
                                                        </select>
                                                        <div id="aktivitas_amal_sholat_wajib-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Tilawah  Al-Qur'an</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="aktivitas_amal_tilawah" id="aktivitas_amal_tilawah" data-bs-toggle="select2"
                                                            required>
                                                            <option>PILIH</option>
                                                            @for ($i = 1; $i <= 100; $i++)
                                                            <option value="{{$i}}">{{$i." KALI"}}</option>
                                                            @endfor
                                                        </select>
                                                        <div id="aktivitas_amal_tilawah-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Shalat Tahajud/Qiyamul Lail</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="aktivitas_amal_tahajud" id="aktivitas_amal_tahajud" data-bs-toggle="select2"
                                                            required>
                                                            <option>PILIH</option>
                                                            @for ($i = 1; $i <= 100; $i++)
                                                            <option value="{{$i}}">{{$i." KALI"}}</option>
                                                            @endfor
                                                        </select>
                                                        <div id="aktivitas_amal_tahajud-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Shalat Duhah</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="aktivitas_amal_duha" id="aktivitas_amal_duha" data-bs-toggle="select2"
                                                            required>
                                                            <option>PILIH</option>
                                                            @for ($i = 1; $i <= 100; $i++)
                                                            <option value="{{$i}}">{{$i." KALI"}}</option>
                                                            @endfor
                                                        </select>
                                                        <div id="aktivitas_amal_duha-error" class="invalid-feedback"></div>
                                                    </div>
                                                </div>   

                                                <div class="mb-3">
                                                    <label>Tanggal Penilaian</label>
                                                    <input type="date" name="tanggal_penilaian_pbi" id="tanggal_penilaian_pbi"
                                                        class="form-control" placeholder="Tanggal Penilaian" required>
                                                        <div id="tanggal_penilaian_pbi-error" class="invalid-feedback"></div>
                                                </div>

                                            </div>
                                            <div class="col-6 col-lg-6">
                                                <div class="mb-3">
                                                    <label>Kegiatan</label>
                                                    <input type="text" name="jenis_penilaian_kegiatan" id="jenis_penilaian_kegiatan"
                                                        class="form-control" placeholder="Kelas" readonly>
                                                        <input type="text" name="id_jenis_penilaian_kegiatan" id="id_jenis_penilaian_kegiatan"
                                                        class="form-control" placeholder="Kelas" hidden>
                                                        <input type="text" name="id" id="id"
                                                        class="form-control" placeholder="Kelas" hidden>
                                                        <div id="jenis_penilaian_kegiatan-error" class="invalid-feedback"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Kelas</label>
                                                    <input type="text" name="kelas" id="kelas"
                                                        class="form-control" placeholder="Kelas" readonly>
                                                        <div id="kelas-error" class="invalid-feedback"></div>
                                                </div>

                                                <!-- keteranga bdang studi -->
                                                <div id="form_keterangan_nilai_bidang_studi">
                                                    <div class="mb-3">
                                                        <label>Nilai Al-Qur'an</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_bidang_studi_alquran" id="nilai_bidang_studi_alquran"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_bidang_studi_alquran-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nilai Aqidah</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_bidang_studi_aqidah" id="nilai_bidang_studi_aqidah"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_bidang_studi_aqidah-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nilai Ibadah</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_bidang_studi_ibadah" id="nilai_bidang_studi_ibadah"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_bidang_studi_ibadah-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nilai Hadits</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_bidang_studi_hadits" id="nilai_bidang_studi_hadits"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_bidang_studi_hadits-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nilai Hadits</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_bidang_studi_sirah" id="nilai_bidang_studi_sirah"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_bidang_studi_sirah-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nilai Tazkiyatun Nafs</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_bidang_studi_tazkiyatun" id="nilai_bidang_studi_tazkiyatun"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_bidang_studi_tazkiyatun-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nilai Fikrul Islam</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_bidang_studi_fikrul" id="nilai_bidang_studi_fikrul"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_bidang_studi_fikrul-error" class="invalid-feedback"></div>
                                                    </div>
                                                </div>

                                                <!-- keterangan karakter -->
                                                <div id="form_keterangan_nilai_karakter">
                                                    <div class="mb-3">
                                                        <label>Nilai Aqidah yang lurus</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_karakter_aqidah" id="nilai_karakter_aqidah"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_karakter_aqidah-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nilai Ibadah yang benar</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_karakter_ibadah" id="nilai_karakter_ibadah"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_karakter_ibadah-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nilai Kepribadian yang matang dan berakhlak mulia</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_karakter_kepribadian" id="nilai_karakter_kepribadian"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_karakter_kepribadian-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nilai Pribadi yang sungguh-sungguh, disiplin dan mampu mengendalikan diri</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_karakter_pribadi" id="nilai_karakter_pribadi"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_karakter_pribadi-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nilai Mampu membaca, menghafal, dan memahami Al-Qur’an</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_karakter_mampu" id="nilai_karakter_mampu"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_karakter_mampu-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nilai Berwawasan luas</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_karakter_wawasan" id="nilai_karakter_wawasan"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_karakter_wawasan-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nilai Karya Wisata/Tafakur Alam</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_kwta" id="nilai_kwta"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_kwta-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nilai Perkemahan</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_perkemahan" id="nilai_perkemahan"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_perkemahan-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nilai Malam Bina Iman dan Taqwa</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_mbit" id="nilai_mbit"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_mbit-error" class="invalid-feedback"></div>
                                                    </div>
                                                </div>

                                                <!-- keterangan aktivitas amal -->
                                                <div id="form_aktivitas_amal_keterangan">
                                                    <div class="mb-3">
                                                        <label>Shalat Rawatib</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="aktivitas_amal_rawatib" id="aktivitas_amal_rawatib" data-bs-toggle="select2"
                                                            required>
                                                            <option>PILIH</option>
                                                            @for ($i = 1; $i <= 100; $i++)
                                                            <option value="{{$i}}">{{$i." KALI"}}</option>
                                                            @endfor
                                                        </select>
                                                        <div id="aktivitas_amal_rawatib-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Dzikir Pagi/Sore</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="aktivitas_amal_dzikri" id="aktivitas_amal_dzikri" data-bs-toggle="select2"
                                                            required>
                                                            <option>PILIH</option>
                                                            @for ($i = 1; $i <= 100; $i++)
                                                            <option value="{{$i}}">{{$i." KALI"}}</option>
                                                            @endfor
                                                        </select>
                                                        <div id="aktivitas_amal_dzikri-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Puasa Sunah</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="aktivitas_amal_puasa" id="aktivitas_amal_puasa" data-bs-toggle="select2"
                                                            required>
                                                            <option>PILIH</option>
                                                            @for ($i = 1; $i <= 100; $i++)
                                                            <option value="{{$i}}">{{$i." KALI"}}</option>
                                                            @endfor
                                                        </select>
                                                        <div id="aktivitas_amal_puasa-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Infaq</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="aktivitas_amal_infaq" id="aktivitas_amal_infaq" data-bs-toggle="select2"
                                                            required>
                                                            <option>PILIH</option>
                                                            @for ($i = 1; $i <= 100; $i++)
                                                            <option value="{{$i}}">{{$i." KALI"}}</option>
                                                            @endfor
                                                        </select>
                                                        <div id="aktivitas_amal_infaq-error" class="invalid-feedback"></div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Keterangan</label>
                                                    <textarea name="keterangan_penilaian_pbi" id="keterangan_penilaian_pbi" class="form-control" placeholder="Keterangan" required></textarea>
                                                    <div id="keterangan_penilaian_pbi-error" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="button" id="saveBtn" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <!-- Your other content -->
    <script>
        $('#dataForm')[0].reset();

        $('#form_bidang_studi').hide();
        $('#form_keterangan_nilai_bidang_studi').hide();

        $('#form_karakter').hide();
        $('#form_keterangan_nilai_karakter').hide();

        $('#form_aktivitas_amal').hide();
        $('#form_aktivitas_amal_keterangan').hide();


        var id_siswa = "{{ $siswa }}";
        var id_kelas = "{{ $kelas }}";
        var periode = "{{ $periode }}";
        var tahun = "{{ $tahun }}";
        var tahun_nama = '';

        const tables = ['aktivitas_amal', 'karakter', 'bidang_studi'];

        const ranges = {
            "sangat_baik": {
                min: 96,
                max: 100
            },
            "baik": {
                min: 86,
                max: 95
            },
            "cukup": {
                min: 80,
                max: 85
            },
            "kurang": {
                min: 0,
                max: 79
            }
        };

        function handleNilaiChange(selectElement, select) {
            const id = selectElement.value;
            select.empty();
            select.append('<option>PILIH</option>'); // Add default option

            if (ranges[id]) {
                const {
                    min,
                    max
                } = ranges[id];
                for (let i = min; i <= max; i++) {
                    select.append('<option value="' + i + '">' + i + '</option>');
                }
            }

            // Display alert if "PILIH" is selected
            if (id === "PILIH") {
                alert("Silahkan Pilih");
            }
        }

        function getRange(input) {
            for (const [key, value] of Object.entries(ranges)) {
                if (input >= value.min && input <= value.max) {
                    return key;
                }
            }
        }
        // tabel
        $(document).ready(function() {
            const baseUrl = "{{ url('guru/penilaian_pbi/data_penilaian_kegiatan_all') }}";
            const defaultFotoSiswaUrl = '{{ asset('assets/admin/img/avatars/avatar.jpg') }}';

            function initializeDataTable(selector, dataSrc, columns) {
                $(selector).DataTable({
                    processing: true,
                    serverSide: false,
                    retrieve: false,
                    destroy: true,
                    responsive: true,
                    ajax: {
                        url: `${baseUrl}/${periode}/${tahun}/${id_siswa}/${id_kelas}`,
                        dataSrc: dataSrc,
                        error: function(xhr, error, thrown) {
                            console.log("AJAX error:", error);
                            console.log("Thrown error:", thrown);
                        }
                    },
                    columns: columns,
                    drawCallback: function(settings) {
                        const api = this.api();
                        const count = api.data().count();
                        $(`${selector}-count`).text(count);
                        if (count > 0) {
                            $(`${selector}-kirim`).show();
                        }
                    }
                });
            }

            // Profil
            $.ajax({
                url: `${baseUrl}/${periode}/${tahun}/${id_siswa}/${id_kelas}`,
                type: 'GET',
                success: function(data) {
                    $('#kegiatan').text('BINA PRIBADI ISLAM (BPI)');
                    $('#tahun_ajaran').text(data.peserta.nama_tahun_ajaran.toUpperCase());
                    $('#pembimbing').text(data.peserta.nama_guru.toUpperCase());
                    $('#nama').text(data.peserta.nama_siswa.toUpperCase());
                    $('#kelas').text(data.peserta.nama_kelas.toUpperCase());
                    $('#kali_pekan').text(data.peserta.sesi_periode);
                    $('#avatarImg').attr('src', data.peserta.foto_siswa ? `{{ url('storage') }}/${data.peserta.foto_siswa}` : defaultFotoSiswaUrl);
                },
                error: function(response) {
                    Swal.fire({
                        title: response.success ? 'Success' : 'Error',
                        text: response.message,
                        icon: response.success ? 'success' : 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });

            // Initialize DataTables
            initializeDataTable(
                '#datatables-ajax-bidang_studi',
                'nilai_bidang_studi',
                [
                    {
                        data: null,
                        name: "rowNumber",
                        render: function(data, type, row) {
                            return 'KALI/PEKAN ' + row.pekan_bidang_studi;
                        }
                    },
                    { data: 'alquran', name: 'alquran' },
                    { data: 'aqidah', name: 'aqidah' },
                    { data: 'tazkiyatun', name: 'tazkiyatun' },
                    { data: 'ibadah', name: 'ibadah' },
                    { data: 'hadits', name: 'hadits' },
                    { data: 'sirah', name: 'sirah' },
                    { data: 'fikrul', name: 'fikrul' },
                    {
                        data: null,
                        name: null,
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-sm btn-danger deleteBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" 
                                data-id_penialain="${row.id_bidang_studi}" data-kategori="bidang_studi">
                                <i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-warning editBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data" 
                                data-id_penialain="${row.id_bidang_studi}" data-kategori="bidang_studi">
                                <i class="fas fa-edit"></i></button>
                            `;
                        }
                    }
                ]
            );

            initializeDataTable(
                '#datatables-ajax-karakter',
                'nilai_karakter',
                [
                    {
                        data: null,
                        name: "rowNumber",
                        render: function(data, type, row) {
                            return 'KALI/PEKAN ' + row.pekan_karakter;
                        }
                    },
                    { data: 'aqdh', name: 'aqdh' },
                    { data: 'ibdh', name: 'ibdh' },
                    { data: 'akhlak', name: 'akhlak' },
                    { data: 'prbd', name: 'prbd' },
                    { data: 'aqr', name: 'aqr' },
                    { data: 'wwsn', name: 'wwsn' },
                    { data: 'kwta', name: 'kwta' },
                    { data: 'perkemahan', name: 'perkemahan' },
                    { data: 'mbit', name: 'mbit' },
                    {
                        data: null,
                        name: null,
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-sm btn-danger deleteBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" 
                                data-id_penialain="${row.id_karakter}" data-kategori="karakter">
                                <i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-warning editBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data" 
                                data-id_penialain="${row.id_karakter}" data-kategori="karakter">
                                <i class="fas fa-edit"></i></button>
                            `;
                        }
                    }
                ]
            );

            initializeDataTable(
                '#datatables-ajax-aktivitas_amal',
                'nilai_amal',
                [
                    {
                        data: null,
                        name: "rowNumber",
                        render: function(data, type, row) {
                            return 'KALI/PEKAN ' + row.pekan_amal;
                        }
                    },
                    { data: 'sholat_wajib', name: 'sholat_wajib', render: function(data) { return data + ' KALI'; } },
                    { data: 'tilawah', name: 'tilawah', render: function(data) { return data + ' HAL'; } },
                    { data: 'tahajud', name: 'tahajud', render: function(data) { return data + ' KALI'; } },
                    { data: 'duha', name: 'duha', render: function(data) { return data + ' KALI'; } },
                    { data: 'rawatib', name: 'rawatib', render: function(data) { return data + ' KALI'; } },
                    { data: 'dzikri', name: 'dzikri', render: function(data) { return data + ' KALI'; } },
                    { data: 'puasa', name: 'puasa', render: function(data) { return data + ' KALI'; } },
                    { data: 'infaq', name: 'infaq', render: function(data) { return data + ' KALI'; } },
                    {
                        data: null,
                        name: null,
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-sm btn-danger deleteBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" 
                                data-id_penialain="${row.id_aktifitas_amal}" data-kategori="aktivitas_amal">
                                <i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-warning editBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data" 
                                data-id_penialain="${row.id_aktifitas_amal}" data-kategori="aktivitas_amal">
                                <i class="fas fa-edit"></i></button>
                            `;
                        }
                    }
                ]
            );
        });

        // hapus
        $(document).on('click', '.deleteBtn', function() {
            var deleteBtn = $(this);
            var id = $(this).data('id_penialain');
            var kategori = $(this).data('kategori');
            deleteBtn.prop('disabled', true).html('<i class="fas fa-spin"></i> Proses Hapus...');
            // Make an Ajax call to delete the record
            Swal.fire({
                title: 'Hapus Data',
                text: 'Apakah Anda Ingin Menghapus Data Ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, saya menghapus data ini'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:  '{{ url('guru/penilaian_pbi/hapus_data_pbi') }}/' + id + '/' + kategori,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            tables.forEach(table => {
                                $(`#datatables-ajax-${table}`).DataTable().ajax.reload();
                            });
                            Swal.fire({
                                title: response.success ? 'Success' : 'Error',
                                text: response.message,
                                icon: response.success ? 'success' : 'error',
                                confirmButtonText: 'OK'
                            });
                        },
                        error: function(response) {
                            tables.forEach(table => {
                                $(`#datatables-ajax-${table}`).DataTable().ajax.reload();
                            });
                            Swal.fire({
                                title: response.success ? 'Success' : 'Error',
                                text: response.message,
                                icon: response.success ? 'success' : 'error',
                                confirmButtonText: 'OK'
                            });
                        },
                        complete: function() {
                            saveBtn.prop('disabled', false).html('<i class="fas fa-trash"></i>');
                        }
                    });
                }
            });
        });

        // edit
        $(document).on('click', '.editBtn', function() {
            var id = $(this).data('id_penialain');
            var kategori = $(this).data('kategori');

            // Make an Ajax call to delete the record
            Swal.fire({
                title: 'Edit Data',
                text: 'Apakah Anda Ingin Mengirim Semua Data ' + 
                    (kategori === 'bidang_studi' ? 'Bidang studi' : 
                    (kategori === 'karakter' ? 'Karakter' : 
                    'Aktivitas Amal')),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, saya merubah data ini'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:  '{{ url('guru/penilaian_pbi/edit_data_pbi') }}/' + id + '/' + kategori,
                        type: 'GET',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            
                            $('#ModalLabel').text('Edit Penilaian PBI KALI');
                            $('#dataForm')[0].reset();
                            $('#formModal').modal('show');

                            if (kategori === 'bidang_studi') {
                                // Reset validation classes
                                $('.form-control').removeClass('is-invalid is-valid');

                                // Show/Hide form sections
                                $('#form_bidang_studi, #form_keterangan_nilai_bidang_studi').show();
                                $('#form_karakter, #form_keterangan_nilai_karakter, #form_aktivitas_amal, #form_aktivitas_amal_keterangan').hide();

                                // Set form input values
                                $('#formModal input[name="id"]').val(id);
                                $('#formModal input[name="tahun_ajaran"]').val(tahun_nama);
                                $('#formModal input[name="siswa"]').val(response.data.nama_siswa.toUpperCase());
                                $('#formModal input[name="kelas"]').val(response.data.nama_kelas.toUpperCase());
                                $('#formModal input[name="tanggal_penilaian_pbi"]').val(response.data.tanggal_penilaian_bidang_studi);
                                $('#formModal input[name="jenis_penilaian_kegiatan"]').val('BIDANG STUDI');
                                $('#formModal input[name="id_jenis_penilaian_kegiatan"]').val('bidang_studi');
                                $('#formModal textarea[name="keterangan_penilaian_pbi"]').val(response.data.ktr_bidang_studi);

                                // Function to update select fields
                                function updateSelectField(bidang, nilai) {
                                    const rangeValue = getRange(nilai);
                                    $(`#formModal select[name="bidang_studi_${bidang}"]`).val(rangeValue).change();
                                    $(`#formModal select[name="nilai_bidang_studi_${bidang}"]`).val(nilai).change();
                                }

                                // Update bidang studi fields
                                const bidangStudi = ['alquran', 'aqidah', 'ibadah', 'hadits', 'sirah', 'tazkiyatun', 'fikrul'];

                                bidangStudi.forEach(bidang => {
                                    updateSelectField(bidang, response.data[bidang]);
                                });

                            } else if (kategori === 'karakter') {
                                $('.form-control').removeClass('is-invalid is-valid');

                                $('#form_karakter, #form_keterangan_nilai_karakter').show();
                                $('#form_bidang_studi, #form_keterangan_nilai_bidang_studi, #form_aktivitas_amal, #form_aktivitas_amal_keterangan').hide();

                                // Set form input values
                                $('#formModal input[name="id"]').val(id);
                                $('#formModal input[name="tahun_ajaran"]').val(tahun_nama);
                                $('#formModal input[name="siswa"]').val(response.data.nama_siswa.toUpperCase());
                                $('#formModal input[name="kelas"]').val(response.data.nama_kelas.toUpperCase());
                                $('#formModal input[name="tanggal_penilaian_pbi"]').val(response.data.tanggal_penilaian_karakter);
                                $('#formModal input[name="jenis_penilaian_kegiatan"]').val('KARAKTER');
                                $('#formModal input[name="id_jenis_penilaian_kegiatan"]').val('karakter');
                                $('#formModal textarea[name="keterangan_penilaian_pbi"]').val(response.data.ktr_karakter);

                                // Function to update select fields
                                function updateSelectField(bidang, nilai) {
                                    const rangeValue = getRange(nilai);
                                    $(`#formModal select[name="karakter_${bidang}"]`).val(rangeValue).change();
                                    $(`#formModal select[name="nilai_karakter_${bidang}"]`).val(nilai).change();
                                }

                                // Update bidang studi fields
                                const karakter = ['aqdh', 'ibdh', 'prbd', 'akhlak', 'aqr', 'wwsn'];
                                const karakterNilai = ['aqidah', 'ibadah', 'kepribadian', 'pribadi', 'mampu', 'wawasan','kwta','perkemahan','mbit'];

                                karakter.forEach((karakterKey, index) => {
                                    updateSelectField(karakterNilai[index], response.data[karakterKey]);
                                });

                            } else {
                                $('.form-control').removeClass('is-invalid is-valid');
                                $('#form_aktivitas_amal, #form_aktivitas_amal_keterangan').show();
                                $('#form_bidang_studi, #form_keterangan_nilai_bidang_studi, #form_karakter, #form_keterangan_nilai_karakter').hide();

                                // Set form input values
                                $('#formModal input[name="id"]').val(id);
                                $('#formModal input[name="tahun_ajaran"]').val(tahun_nama);
                                $('#formModal input[name="siswa"]').val(response.data.nama_siswa.toUpperCase());
                                $('#formModal input[name="kelas"]').val(response.data.nama_kelas.toUpperCase());
                                $('#formModal input[name="tanggal_penilaian_pbi"]').val(response.data.tanggal_penilaian_amal);
                                $('#formModal input[name="jenis_penilaian_kegiatan"]').val('AKTIVITAS AMAL');
                                $('#formModal input[name="id_jenis_penilaian_kegiatan"]').val('aktivitas_amal');
                                $('#formModal textarea[name="keterangan_penilaian_pbi"]').val(response.data.ktr_amal);

                                const aktivitasAmal = ['sholat_wajib', 'tilawah', 'tahajud', 'duha', 'rawatib', 'dzikri', 'puasa', 'infaq'];

                                aktivitasAmal.forEach((aktivitas) => {
                                    updateSelectField(aktivitas, response.data[aktivitas]);
                                });

                                function updateSelectField(bidang, nilai) {
                                    const rangeValue = getRange(nilai);
                                    const selectField = $(`#formModal select[name="aktivitas_amal_${bidang}"]`);

                                    if (selectField.length) {
                                        selectField.val(rangeValue).change(); // Set the range value
                                        selectField.val(nilai).change();      // Set the actual value
                                    }
                                }
                            }
                        },
                        error: function(response) {
                            $('#datatables-ajax-aktivitas_amal').DataTable().ajax.reload();
                            $('#datatables-ajax-karakter').DataTable().ajax.reload();
                            $('#datatables-ajax-bidang_studi').DataTable().ajax.reload();
                            Swal.fire({
                                title: response.success ? 'Success' : 'Error',
                                text: response.message,
                                icon: response.success ? 'success' : 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        });

        // save
        $(document).on('click', '#saveBtn', function() {
            var saveBtn = $(this);
            var kategori = document.getElementById('id_jenis_penilaian_kegiatan').value;
            var id = document.getElementById('id').value;
            var url = '{{ url('guru/penilaian_pbi/update_penilaian_pbi') }}/' + id + '/' + kategori;
            var form = $('#dataForm')[0];
            var formData = new FormData(form);

            // Disable the button and show a loading spinner
            saveBtn.prop('disabled', true).html('<i class="fas fa-spin"></i> Proses Simpan...');

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('.select2').val(null).trigger('change');
                    $('#dataForm')[0].reset();
                    $('#formModal').modal('hide');
                    tables.forEach(table => {
                        $(`#datatables-ajax-${table}`).DataTable().ajax.reload();
                    });

                    Swal.fire({
                        title: response.success ? 'Success' : 'Error',
                        text: response.message,
                        icon: response.success ? 'success' : 'error',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(xhr) {
                    let response = xhr.responseJSON;
                    if (response) {
                        let errors = response; 
                        $('.form-control').removeClass('is-invalid').removeClass('is-valid');
                        $('.invalid-feedback').empty();

                        Object.keys(errors).forEach(function(key) {
                            let input = $("#" + key);
                            let errorDiv = $("#" + key + "-error");

                            input.addClass("is-invalid");
                            errorDiv.html('<strong>' + errors[key][0] + '</strong>'); 

                            if (input.hasClass("select2-hidden-accessible")) {
                                input.parent().addClass("is-invalid");
                            }
                        });
                    }
                },
                complete: function() {
                    // Re-enable the button and reset the text
                    deleteBtn.prop('disabled', false).html('Simpan');
                }
            });
        });

        // grafik
        document.addEventListener("DOMContentLoaded", function() {
            // Fungsi untuk menampilkan persentase di tengah chart
            function drawCenterText(chart, value) {
                var width = chart.chart.width,
                    height = chart.chart.height,
                    ctx = chart.chart.ctx;
                ctx.restore();
                var fontSize = (height / 100).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = "middle";

                // Persentase sudah diambil dari value
                var percentage = value + "%";

                // Posisi teks
                var textX = Math.round((width - ctx.measureText(percentage).width) / 2),
                    textY = height / 2;

                // Gambar teks
                ctx.fillText(percentage, textX, textY);
                ctx.save();
            }

            // Registrasi plugin untuk semua doughnut charts
            Chart.plugins.register({
                afterDraw: function(chart) {
                    if (chart.config.type === 'doughnut') {
                        // Ambil value dari dataset pertama (yang diberikan ke fungsi createDoughnutChart)
                        var value = chart.config.data.datasets[0].data[0];
                        drawCenterText(chart, value);
                    }
                }
            });

            // Fungsi untuk membuat doughnut chart dengan data
            function createDoughnutChart(chartId, color, value, backgroundColor = "#E8EAED") {
                new Chart(document.getElementById(chartId), {
                    type: "doughnut",
                    data: {
                        labels: ["Value", ""],
                        datasets: [{
                            data: [value, 100 - value], // Total 100% untuk chart
                            backgroundColor: [color, backgroundColor],
                            borderColor: "transparent"
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutoutPercentage: 65,
                        legend: {
                            display: false
                        },
                        tooltips: {
                            enabled: false // Disable tooltips
                        }
                    }
                });
            }

            // Lakukan AJAX request untuk mendapatkan data
            $.ajax({
                url: "{{ url('guru/penilaian_pbi/data_penilaian_kegiatan_all') }}/" 
                    + periode +
                    '/' + tahun +
                    '/' + id_siswa +
                    '/' + id_kelas,
                method: 'GET',
                success: function(response) {                    
                    createDoughnutChart("chartjs-bidang_studi", window.theme.primary, response.jumlah_bidang_studi.jumlah_bidang_studi);
                    createDoughnutChart("chartjs-karakter", window.theme.warning, response.jumlah_karakter.jumlah_karakter);
                    createDoughnutChart("chartjs-amal", window.theme.danger, response.jumlah_amal.jumlah_amal);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                }
            });
        });



    </script>
@endsection
