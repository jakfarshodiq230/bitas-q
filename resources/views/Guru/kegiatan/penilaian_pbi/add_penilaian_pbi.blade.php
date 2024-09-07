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
            max-width: 800px;
            margin: 0 auto;
            padding: 10px;
        }

        .profile-item {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 5px;
        }

        .profile-item span.label {
            font-weight: bold;
            margin-right: 5px;
        }

        .profile-item span.separator {
            margin-right: 5px;
        }

        .profile-item span.value {
            margin-left: 5px;
        }
    </style>
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title" id="judul_header">
                    FORM PENILAIAN PESERTA {{ strtoupper($judul_3) }}
                </h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row border-navy">
                                <div class="col-md-3 profile">
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Tahun Ajaran</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="tahun_ajaran_tahfidz"
                                            style="flex: 1;">{{ $tahun->nama_tahun_ajaran }}</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Kegiatan</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="kegiatan" style="flex: 1;">
                                        {{ $periode->jenis_periode === 'tahfidz' ? 'TAHFIDZH/MURAJAAH' : ($periode->jenis_periode === 'tahsin' ? 'TAHSIN/MATERIKULASI' : 'BINA PRIBADI ISLAM (PBI)') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3 profile">
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Data Bidang Studi</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="countdata-bidang_studi" style="flex: 1;">0</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Data Karakter</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="countdata-karakter" style="flex: 1;">0</span>
                                    </div>
                                </div>
                                <div class="col-md-2 profile">
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Data Aktivitas Amal</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="countdata-aktivitas_amal" style="flex: 1;">0</span>
                                    </div>
                                </div>
                                <div class="col-md-4 profile">
                                    <div class="profile-item mt-4 d-flex justify-content-center">
                                        <button class="btn btn-outline-primary addBtn me-2  text-end {{ $periode->status_periode === 0 ? 'disabled' : '' }}"
                                            id="addBtn">Penilaian
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- bidang studi --}}
                    <div class="card" id="bidang_studi">
                        <div class="card-body">
                        <button class="btn btn-outline-warning text-start kirimBtn mb-2" id="kirimBtn-bidang_studi" data-kategori="bidang_studi">Kirim
                        Data </button>
                            <table id="datatables-ajax-bidang_studi" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Siswa</th>
                                        <th>Al-Qur'an</th>
                                        <th>Aqidah</th>
                                        <th>Taz</th>
                                        <th>Ibadah</th>
                                        <th>Hadits</th>
                                        <th>Sirah</th>
                                        <th>Fikrul Islam</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Siswa</th>
                                        <th>Al-Qur'an</th>
                                        <th>Aqidah</th>
                                        <th>Taz</th>
                                        <th>Ibadah</th>
                                        <th>Hadits</th>
                                        <th>Sirah</th>
                                        <th>Fikrul Islam</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    {{-- Karakter --}}
                    <div class="card" id="karakter">
                        <div class="card-body">
                        <button class="btn btn-outline-warning text-start kirimBtn mb-2" id="kirimBtn-karakter" data-kategori="karakter">Kirim
                        Data </button>
                            <table id="datatables-ajax-karakter" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Siswa</th>
                                        <th>AQDH</th>
                                        <th>IBDH</th>
                                        <th>AKHLK</th>
                                        <th>PRBD</th>
                                        <th>AQR</th>
                                        <th>WWSN</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Siswa</th>
                                        <th>AQDH</th>
                                        <th>IBDH</th>
                                        <th>AKHLK</th>
                                        <th>PRBD</th>
                                        <th>AQR</th>
                                        <th>WWSN</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    {{-- Aktivitas Amal --}}
                    <div class="card" id="aktivitas_amal">
                        <div class="card-body">
                        <button class="btn btn-outline-warning text-start kirimBtn mb-2" id="kirimBtn-aktivitas_amal" data-kategori="aktivitas_amal">Kirim
                        Data </button>
                            <table id="datatables-ajax-aktivitas_amal" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Siswa</th>
                                        <th>SHOLAT WAJIB</th>
                                        <th>TILAWAH</th>
                                        <th>TAHAJJUD</th>
                                        <th>DUHA</th>
                                        <th>RAWATIB</th>
                                        <th>DZIKIR</th>
                                        <th>PUASA</th>
                                        <th>INFAQ</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Siswa</th>
                                        <th>SHOLAT WAJIB</th>
                                        <th>TILAWAH</th>
                                        <th>TAHAJJUD</th>
                                        <th>DUHA</th>
                                        <th>RAWATIB</th>
                                        <th>DZIKIR</th>
                                        <th>PUASA</th>
                                        <th>INFAQ</th>
                                        <th>Action</th>
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
                                                        value="{{ $tahun->nama_tahun_ajaran }}" readonly>
                                                    <input type="text" name="id_tahun_ajaran" id="id_tahun_ajaran"
                                                        class="form-control" value="{{ $tahun->id_tahun_ajaran }}"
                                                        placeholder="id_tahun_ajaran" hidden>
                                                        <input type="text" name="id_periode" id="id_periode"
                                                        class="form-control" value="{{ $tahun->id_periode }}"
                                                        placeholder="id_periode" hidden>
                                                        <input type="text" name="sesi_periode" id="sesi_periode"
                                                        class="form-control" value="{{ $periode->sesi_periode }}"
                                                        placeholder="sesi_periode" hidden>
                                                    <div id="tahun_ajaran-error" class="invalid-feedback"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Siswa</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="siswa" id="siswa" data-bs-toggle="select2" required>
                                                        <option value="PILIH">PILIH</option>
                                                    </select>
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
                                                            name="bidang_studi_tazkiyatunnafs" id="bidang_studi_tazkiyatunnafs" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_bidang_studi_tazkiyatunnafs\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="bidang_studi_tazkiyatunnafs-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Fikrul Islam</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                            name="bidang_studi_fikrulislam" id="bidang_studi_fikrulislam" data-bs-toggle="select2"
                                                            onchange="handleNilaiChange(this, $('select[name=\'nilai_bidang_studi_fikrulislam\']'))"
                                                            required>
                                                            <option>PILIH</option>
                                                            <option value="sangat_baik">SANGAT BAIK</option>
                                                            <option value="baik">BAIK</option>
                                                            <option value="cukup">CUKUP</option>
                                                            <option value="kurang">KURANG</option>
                                                        </select>
                                                        <div id="bidang_studi_fikrulislam-error" class="invalid-feedback"></div>
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
                                                            name="aktivitas_amal_dhuha" id="aktivitas_amal_dhuha" data-bs-toggle="select2"
                                                            required>
                                                            <option>PILIH</option>
                                                            @for ($i = 1; $i <= 100; $i++)
                                                            <option value="{{$i}}">{{$i." KALI"}}</option>
                                                            @endfor
                                                        </select>
                                                        <div id="aktivitas_amal_dhuha-error" class="invalid-feedback"></div>
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
                                                    <label>Penilaian</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="jenis_penilaian_kegiatan" id="jenis_penilaian_kegiatan" data-bs-toggle="select2" onchange="handleJenisPenilaianChange()" required>
                                                        <option value="PILIH">PILIH</option>
                                                        <option value="bidang_studi">BIDANG STUDI</option>
                                                        <option value="karakter">KARAKTER</option>
                                                        <option value="aktifitas_amal">AKTIVITAS AMAL</option>
                                                    </select>
                                                    <input type="text" name="id_periode" id="id_periode"
                                                        class="form-control" value="{{ $periode->id_periode }}"
                                                        placeholder="id_tahun_ajaran" hidden>
                                                        <div id="jenis_penilaian_kegiatan-error" class="invalid-feedback"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Kelas</label>
                                                    <input type="text" name="kelas" id="kelas"
                                                        class="form-control" placeholder="Kelas" readonly>
                                                    <input type="text" name="id_kelas" id="id_kelas"
                                                        class="form-control" placeholder="id_kelas" hidden>
                                                    <input type="text" name="id_peserta_kegiatan"
                                                        id="id_peserta_kegiatan" class="form-control"
                                                        placeholder="id_peserta_kegiatan" hidden>
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
                                                            name="nilai_bidang_studi_tazkiyatunnafs" id="nilai_bidang_studi_tazkiyatunnafs"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_bidang_studi_tazkiyatunnafs-error" class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nilai Fikrul Islam</label>
                                                        <select class="form-control select2 mb-4 me-sm-2 mt-0 "
                                                            name="nilai_bidang_studi_fikrulislam" id="nilai_bidang_studi_fikrulislam"
                                                            data-bs-toggle="select2" required>
                                                            <option>PILIH</option>
                                                        </select>
                                                        <div id="nilai_bidang_studi_fikrulislam-error" class="invalid-feedback"></div>
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
                                                            name="aktivitas_amal_dzikir" id="aktivitas_amal_dzikir" data-bs-toggle="select2"
                                                            required>
                                                            <option>PILIH</option>
                                                            @for ($i = 1; $i <= 100; $i++)
                                                            <option value="{{$i}}">{{$i." KALI"}}</option>
                                                            @endfor
                                                        </select>
                                                        <div id="aktivitas_amal_dzikir-error" class="invalid-feedback"></div>
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

        $('#dataForm')[0].reset();

        $('#form_bidang_studi').hide();
        $('#form_keterangan_nilai_bidang_studi').hide();

        $('#form_karakter').hide();
        $('#form_keterangan_nilai_karakter').hide();

        $('#form_aktivitas_amal').hide();
        $('#form_aktivitas_amal_keterangan').hide();

        $('#kirimBtn-bidang_studi').hide();        
        $('#kirimBtn-karakter').hide(); 
        $('#kirimBtn-aktivitas_amal').hide(); 

        function handleJenisPenilaianChange() {
            var jenisPenilaian = document.getElementById("jenis_penilaian_kegiatan").value;
            var forms = {
                bidang_studi: ['#form_bidang_studi', '#form_keterangan_nilai_bidang_studi'],
                karakter: ['#form_karakter', '#form_keterangan_nilai_karakter'],
                aktifitas_amal: ['#form_aktivitas_amal', '#form_aktivitas_amal_keterangan']
            };

            $('.form-control').removeClass('is-invalid is-valid');
            $.each(forms, function(key, value) {
                if (jenisPenilaian === key) {
                    $(value.join(',')).show();
                } else {
                    $(value.join(',')).hide();
                }
            });
        }

        $(document).ready(function() {
            var periode = "{{ $periode->id_periode }}";
            var tahun = "{{ $tahun->id_tahun_ajaran }}";

            $('#datatables-ajax-bidang_studi').DataTable({
                processing: true,
                serverSide: false,
                retrieve: false,
                destroy: true,
                responsive: true,
                ajax: {
                    url: "{{ url('guru/penilaian_pbi/data_penilaian_kegiatan') }}/" + periode +
                        '/' + tahun,
                    dataSrc: "nilai_bidang_studi",
                    error: function(xhr, error, thrown) {
                        console.log("AJAX error:", error);
                        console.log("Thrown error:", thrown);
                    }
                },

                columns: [{
                        "data": null,
                        "name": "rowNumber",
                        "render": function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'nama_siswa',
                        name: 'nama_siswa',
                        render: function(data, type, row) {
                            return row.nama_siswa.trim().toUpperCase()+'<br>'+row.nisn_siswa +'<br>'+row.nama_kelas.toUpperCase()+'<br>'+'PEKAN KE-'+row.pekan_bidang_studi;
                        }
                    },
                    {
                        data: 'alquran',
                        name: 'alquran'
                    },
                    {
                        data: 'aqidah',
                        name: 'aqidah'
                    },
                    {
                        data: 'ibadah',
                        name: 'ibadah'
                    },
                    {
                        data: 'hadits',
                        name: 'hadits'
                    },
                    {
                        data: 'sirah',
                        name: 'sirah'
                    },
                    {
                        data: 'tazkiyatun',
                        name: 'tazkiyatun'
                    },
                    {
                        data: 'fikrul',
                        name: 'fikrul'
                    },
                    {
                        data: null,
                        name: null,
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-sm btn-danger deleteBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" 
                                data-id_penialain="${row.id_bidang_studi}" data-kategori="bidang_studi">
                                <i class="fas fa-trash"></i></button>
                                `;
                        }
                    }
                ],
                drawCallback: function(settings) {
                    var api = this.api();
                    var count = api.data().count();
                    $('#countdata-bidang_studi').text(count);
                    if (count > 0) {
                        $('#kirimBtn-bidang_studi').show()
                    }
                }
            });

            $('#datatables-ajax-karakter').DataTable({
                processing: true,
                serverSide: false,
                retrieve: false,
                destroy: true,
                responsive: true,
                ajax: {
                    url: "{{ url('guru/penilaian_pbi/data_penilaian_kegiatan') }}/" + periode +
                        '/' + tahun,
                    dataSrc: "nilai_karakter",
                    error: function(xhr, error, thrown) {
                        console.log("AJAX error:", error);
                        console.log("Thrown error:", thrown);
                    }
                },

                columns: [{
                        "data": null,
                        "name": "rowNumber",
                        "render": function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'nama_siswa',
                        name: 'nama_siswa',
                        render: function(data, type, row) {
                            return row.nama_siswa.trim().toUpperCase()+'<br>'+row.nisn_siswa +'<br>'+row.nama_kelas.toUpperCase()+'<br>'+'PEKAN KE-'+row.pekan_karakter;
                        }
                    },
                    {
                        data: 'aqdh',
                        name: 'aqdh'
                    },
                    {
                        data: 'ibdh',
                        name: 'ibdh'
                    },
                    {
                        data: 'akhlak',
                        name: 'akhlak'
                    },
                    {
                        data: 'prbd',
                        name: 'prbd'
                    },
                    {
                        data: 'aqr',
                        name: 'aqr'
                    },
                    {
                        data: 'wwsn',
                        name: 'wwsn'
                    },
                    {
                        data: null,
                        name: null,
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-sm btn-danger deleteBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" 
                                data-id_penialain="${row.id_karakter}" data-kategori="karakter">
                                <i class="fas fa-trash"></i></button>
                                `;
                        }
                    }
                ],
                drawCallback: function(settings) {
                    var api = this.api();
                    var count = api.data().count();
                    $('#countdata-karakter').text(count);
                    if (count > 0) {
                        $('#kirimBtn-karakter').show()
                    }
                }
            });

            $('#datatables-ajax-aktivitas_amal').DataTable({
                processing: true,
                serverSide: false,
                retrieve: false,
                destroy: true,
                responsive: true,
                ajax: {
                    url: "{{ url('guru/penilaian_pbi/data_penilaian_kegiatan') }}/" + periode +
                        '/' + tahun,
                    dataSrc: "nilai_amal",
                    error: function(xhr, error, thrown) {
                        console.log("AJAX error:", error);
                        console.log("Thrown error:", thrown);
                    }
                },

                columns: [{
                        "data": null,
                        "name": "rowNumber",
                        "render": function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'nama_siswa',
                        name: 'nama_siswa',
                        render: function(data, type, row) {
                            return row.nama_siswa.trim().toUpperCase()+'<br>'+row.nisn_siswa +'<br>'+row.nama_kelas.toUpperCase()+'<br>'+'PEKAN KE-'+row.pekan_amal;
                        }
                    },
                    {
                        data: 'sholat_wajib',
                        name: 'sholat_wajib'
                    },
                    {
                        data: 'tilawah',
                        name: 'tilawah'
                    },
                    {
                        data: 'tahajud',
                        name: 'tahajud'
                    },
                    {
                        data: 'duha',
                        name: 'duha'
                    },
                    {
                        data: 'rawatib',
                        name: 'rawatib'
                    },
                    {
                        data: 'dzikri',
                        name: 'dzikri'
                    },
                    {
                        data: 'puasa',
                        name: 'puasa'
                    },
                    {
                        data: 'infaq',
                        name: 'infaq'
                    },
                    {
                        data: null,
                        name: null,
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-sm btn-danger deleteBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" 
                                data-id_penialain="${row.id_aktifitas_amal}" data-kategori="aktivitas_amal">
                                <i class="fas fa-trash"></i></button>
                                `;
                        }
                    }
                ],
                drawCallback: function(settings) {
                    var api = this.api();
                    var count = api.data().count();
                    $('#countdata-aktivitas_amal').text(count);
                    if (count > 0) {
                        $('#kirimBtn-aktivitas_amal').show()
                    }
                }
            });
        });


        $(document).ready(function() {
            var periode = "{{ $periode->id_periode }}";
            var tahun = "{{ $tahun->id_tahun_ajaran }}";
            var guru = "{{ session('user')['id'] }}";
            var kegiatan = "{{ $periode->jenis_periode }}";
            $.ajax({
                url: '{{ url('guru/penilaian_pbi/data_siswa') }}/' + tahun + '/' + periode + '/' +
                    guru,
                method: 'GET',
                success: function(data) {
                    var select = $('select[name="siswa"]');
                    select.empty();
                    select.append('<option value="PILIH" selected>PILIH</option>'); // Add default option
                    $.each(data.siswa, function(key, value) {
                        select.append('<option value="' + value.id_peserta_pbi + '">' + value
                            .nama_siswa.trim().toUpperCase() + ' [ ' + value.nisn_siswa +
                            ' ]' + '</option>');
                    });
                    // Update #kelas text when an option is selected
                    select.change(function() {
                        var selectedId = $(this).val();
                        var selectedSiswa = data.siswa.find(function(siswa) {
                            return siswa.id_peserta_pbi == selectedId;
                        });
                        if (selectedSiswa) {
                            $('#kelas').val(selectedSiswa.nama_kelas.trim().toUpperCase());
                            $('#id_kelas').val(selectedSiswa.id_kelas);
                            $('#id_peserta_kegiatan').val(selectedSiswa.id_peserta_kegiatan);
                        } else {
                            $('#kelas').val(''); // Handle case where no student is selected
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });

        // Add Button
        $('#addBtn').on('click', function() {
            $('#ModalLabel').text('TAMBAH PENILAIAN PESERTA BPI (KALI/PEKAN) ');
            $('#dataForm')[0].reset();
            $('#formModal').modal('show');
        });

        // save dan update data
        $('#saveBtn').on('click', function() {
            var url = '{{ url('guru/penilaian_pbi/store_penilaian') }}';
            var form = $('#dataForm')[0];
            var formData = new FormData(form);
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

                    $('#datatables-ajax-aktivitas_amal').DataTable().ajax.reload();
                    $('#datatables-ajax-karakter').DataTable().ajax.reload();
                    $('#datatables-ajax-bidang_studi').DataTable().ajax.reload();

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
                        let errors = response; // Use the response directly, which contains the errors
                        $('.form-control').removeClass('is-invalid').removeClass('is-valid');
                        $('.invalid-feedback').empty();

                        Object.keys(errors).forEach(function(key) {
                            console.log(key);
                            let input = $("#" + key);
                            let errorDiv = $("#" + key + "-error");

                            input.addClass("is-invalid");
                            errorDiv.html('<strong>' + errors[key][0] + '</strong>'); 

                            if (input.hasClass("select2-hidden-accessible")) {
                                input.parent().addClass("is-invalid");
                            }
                        });
                    }
                }
            });
        });

        // delete 
        $(document).on('click', '.deleteBtn', function() {
            var id = $(this).data('id_penialain');
            var kategori = $(this).data('kategori');

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
                            $('#datatables-ajax-aktivitas_amal').DataTable().ajax.reload();
                            $('#datatables-ajax-karakter').DataTable().ajax.reload();
                            $('#datatables-ajax-bidang_studi').DataTable().ajax.reload();
                            if(response.kategori === 'bidang_studi'){
                                $('#kirimBtn-bidang_studi').hide();  
                                $('#datatables-ajax-aktivitas_amal').DataTable().ajax.reload();      
                            }else if(response.kategori === 'karakter'){
                                $('#kirimBtn-karakter').hide(); 
                                $('#datatables-ajax-karakter').DataTable().ajax.reload();
                            }else{
                                $('#kirimBtn-aktivitas_amal').hide(); 
                                $('#datatables-ajax-aktivitas_amal').DataTable().ajax.reload();
                            }
                            Swal.fire({
                                title: response.success ? 'Success' : 'Error',
                                text: response.message,
                                icon: response.success ? 'success' : 'error',
                                confirmButtonText: 'OK'
                            });
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

        $(document).on('click', '#kirimBtn-bidang_studi, #kirimBtn-karakter, #kirimBtn-aktivitas_amal', function() {
            var periode = "{{ $periode->id_periode }}";
            var tahun = "{{ $tahun->id_tahun_ajaran }}";
            var kategori = $(this).data('kategori');
            
            Swal.fire({
                title: 'Kirim Data',
                text: 'Apakah Anda Ingin Mengirim Semua Data ' + 
                    (kategori === 'bidang_studi' ? 'Bidang studi' : 
                    (kategori === 'karakter' ? 'Karakter' : 
                    'Aktivitas Amal')),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, saya mengirim semua data ini'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mengirim...',
                        text: 'Sedang mengirim data, harap tunggu.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: '{{ url('guru/penilaian_pbi/kirim_data_penilaian_pbi') }}/' +
                            periode + '/' + tahun + '/' + kategori,
                        type: 'GET',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.close(); // Close the loading dialog
                            Swal.fire({
                                title: response.success ? 'Sukses' : 'Error',
                                text: response.message,
                                icon: response.success ? 'success' : 'error',
                                confirmButtonText: 'OK'
                            });
                            if(response.kategori === 'bidang_studi'){
                                $('#kirimBtn-bidang_studi').hide();  
                                $('#datatables-ajax-aktivitas_amal').DataTable().ajax.reload();      
                            }else if(response.kategori === 'karakter'){
                                $('#kirimBtn-karakter').hide(); 
                                $('#datatables-ajax-karakter').DataTable().ajax.reload();
                            }else{
                                $('#kirimBtn-aktivitas_amal').hide(); 
                                $('#datatables-ajax-aktivitas_amal').DataTable().ajax.reload();
                            }
                            
                        },
                        error: function(xhr, status, error) {
                            Swal.close(); // Close the loading dialog
                            Swal.fire({
                                title: 'Error',
                                text: xhr.responseJSON?.message ||
                                    'Terjadi kesalahan saat mengirim data.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });

                            $('#datatables-ajax-aktivitas_amal').DataTable().ajax.reload();
                            $('#datatables-ajax-karakter').DataTable().ajax.reload();
                            $('#datatables-ajax-bidang_studi').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });
        
    </script>
@endsection
