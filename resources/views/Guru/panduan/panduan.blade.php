@extends('Guru.layout')
@section('content')
<main class="content">
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title" id="judul_header">
            PANDUAN PENGGUNAAN SISTEM BITAS-Q
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div id="changelog">
                                            <h4 class="d-inline-block"><span class="badge bg-primary">Al-Qur'an</span></h4>
                                            <h5 class="d-inline-block">- Penilaian</h5>
                                            <ul>
                                                <li>Pilih menu kegiatan</li>
                                                <li>Pilih Al-Qur'an</li>
                                                <li>Klik <b>Penilaian</b></li>
                                                <li>Klik Penilian akan tampil form penilaian</li>
                                                <li>Pilih kegiatan penilaian dan selanjutnya lengkapi form penilaian</li>
                                                <li>Setelah selesai, jika tidak ada perubahan data maka lakukan kirim data atau akiri penilaian</li>
                                            </ul>

                                            <h4 class="d-inline-block"><span class="badge bg-primary">Al-Qur'an</span></h4>
                                            <h5 class="d-inline-block">- Hasil Penilaian</h5>
                                            <ul>
                                                <li>Pilih menu kegiatan</li>
                                                <li>Pilih Al-Qur'an</li>
                                                <li>Klik <b>ikon eye</b></li>
                                                <li>Klik Penilian akan tampil form penilaian</li>
                                                <li>Pilih Peserta yang akan di lihat hasil penilaian dengan mengkilik <b>ikon eye</b> dan bisa melakukan perubahan data penilaian</li>
                                                <li>Jika ingin mencetak kartu hasil penilaian klik <b>ikon print</b></li>
                                            </ul>

                                            <h4 class="d-inline-block"><span class="badge bg-primary">Al-Qur'an</span></h4>
                                            <h5 class="d-inline-block">- Rapor</h5>
                                            <ul>
                                                <li>Pilih menu kegiatan</li>
                                                <li>Pilih Al-Qur'an</li>
                                                <li>Klik <b>ikon users</b></li>
                                                <li>Klik <b>ikon eye</b> melihat hasil rapor Al-Qur'an</li>
                                                <li>Klik <b>ikon download</b> untuk mendownload rapor Al-Qur'an</li>
                                                <li>Nilai rapor Al-Qur'an secara otomatis dari hasil nilai setiap penilaian setoran atau kegiatan tahfidz, tahsin, materikulasi dan muraja'ah Al-Qur'an</li>
                                                <li>Nilai pengembangan diri rapor Al-Qur'an tidak secara otomatis maka, dilakukan penilaian oleh pembimbing atau guru</li>
                                            </ul>

                                            <h4 class="d-inline-block"><span class="badge bg-primary">Bina Pribadi Islam (BPI)</span></h4>
                                            <h5 class="d-inline-block">- Penilaian</h5>
                                            <ul>
                                                <li>Pilih menu kegiatan</li>
                                                <li>Pilih Bina Pribadi Islam (BPI)</li>
                                                <li>Klik <b>Penilaian</b></li>
                                                <li>Klik Penilian akan tampil form penilaian</li>
                                                <li>Pilih kegiatan penilaian dan selanjutnya lengkapi form penilaian</li>
                                                <li>Setelah selesai, jika tidak ada perubahan data maka lakukan kirim data atau akiri penilaian</li>
                                            </ul>

                                            <h4 class="d-inline-block"><span class="badge bg-primary">Bina Pribadi Islam (BPI)</span></h4>
                                            <h5 class="d-inline-block">- Hasil Penilaian</h5>
                                            <ul>
                                                <li>Pilih menu kegiatan</li>
                                                <li>Pilih Bina Pribadi Islam (BPI)</li>
                                                <li>Klik <b>ikon eye</b></li>
                                                <li>Klik Penilian akan tampil form penilaian</li>
                                                <li>Pilih Peserta yang akan di lihat hasil penilaian dengan mengkilik <b>ikon eye</b> dan bisa melakukan perubahan data penilaian</li>
                                                <li>Jika ingin mencetak kartu hasil penilaian klik <b>ikon print</b></li>
                                            </ul>

                                            <h4 class="d-inline-block"><span class="badge bg-primary">Bina Pribadi Islam (BPI)</span></h4>
                                            <h5 class="d-inline-block">- Rapor</h5>
                                            <ul>
                                                <li>Pilih menu kegiatan</li>
                                                <li>Pilih Bina Pribadi Islam (BPI)</li>
                                                <li>Klik <b>ikon users</b></li>
                                                <li>Klik <b>ikon eye</b> melihat hasil rapor Bina Pribadi Islam (BPI)</li>
                                                <li>Klik <b>ikon download</b> untuk mendownload rapor Bina Pribadi Islam (BPI)</li>
                                                <li>Nilai rapor Bina Pribadi Islam (BPI) secara otomatis dari hasil nilai setiap penilaian perpekan</li>
                                            </ul>

                                            <h4 class="d-inline-block"><span class="badge bg-primary">Sertifikasi</span></h4>
                                            <h5 class="d-inline-block">- Penilaian</h5>
                                            <ul>
                                                <li>Pilih menu sertifikasi</li>
                                                <li>Pilih penilaian</li>
                                                <li>Klik <b>ikon users</b> dengan periode bersetatus <b>buka penilaian</b></li>
                                                <li>Klik <b>ikon eye</b> melihat hasil rapor Bina Pribadi Islam (BPI)</li>
                                                <li>Klik <b>ikon download</b> untuk mendownload rapor Bina Pribadi Islam (BPI)</li>
                                            </ul>

                                            <h4 class="d-inline-block"><span class="badge bg-primary">Sertifikasi</span></h4>
                                            <h5 class="d-inline-block">- Daftar</h5>
                                            <ul>
                                                <li>Pilih menu sertifikasi</li>
                                                <li>Pilih daftar</li>
                                                <li>Klik <b>ikon users</b> dengan periode bersetatus <b>buka pendaftaran</b></li>
                                                <li>Klik <b>pendaftaran</b> akan tampil form pendaftaran, lanjutkan lengkapai data pendaftaran</li>
                                                <li>pendaftaran bisa dilakukan setatus periode sebelum tutup pendafatarn</li>
                                                <li>Klik <b>ikon eye</b> untuk melihat hasil penilaian sertifikasi</li>
                                                <li>Klik <b>ikon download nilai</b> untuk melihat hasil penilaian sertifikasi</li>
                                                <li>Klik <b>ikon download sertifikasi</b>untuk download sertifikat</li>
                                            </ul>

                                            <h4 class="d-inline-block"><span class="badge bg-primary">Standar Penilaian</span></h4>
                                            <h5 class="d-inline-block">- Predikat Nilai</h5>
                                            <ul>
                                                <li>Nilai 96 sampai 100 <b>Sangat Baik</b></li>
                                                <li>Nilai 86 sampai 95 <b>Baik</b></li>
                                                <li>Nilai 80 sampai 85 <b>Cukup</b></li>
                                                <li>Nilai 0 sampai 79 <b>Kurang</b></li>
                                            </ul>

                                            <h4 class="d-inline-block"><span class="badge bg-primary">Standar Penilaian</span></h4>
                                            <h5 class="d-inline-block">- Predikat Nilai Khatam</h5>
                                            <ul>
                                                <li>Khatam 5  <b>Sangat Baik</b></li>
                                                <li>Khatam 1 sampai 4 <b>Baik</b></li>
                                                <li>Khatam dibawah 1 <b>Kurang</b></li>
                                            </ul>


                                            <h4 class="d-inline-block"><span class="badge bg-primary">Standar Penilaian</span></h4>
                                            <h5 class="d-inline-block">- Predikat Nilai Bina Pribadi Islam Kali/Pekan</h5>
                                            <ul>
                                                <li>Kali/Pekan 20 sampai 100  <b>Sangat Baik</b></li>
                                                <li>Kali/Pekan 11 sampai 19 <b>Baik</b></li>
                                                <li>Kali/Pekan 1 sampai 10 <b>Cukup</b></li>
                                                <li>Kali/Pekan dibawah 1 <b>Kurang</b></li>
                                            </ul>
                                        </div><!-- /#changelog -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
    </div>
</main>
@endsection



