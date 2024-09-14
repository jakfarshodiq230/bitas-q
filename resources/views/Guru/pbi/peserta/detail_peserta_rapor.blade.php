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
        .profile-item .value ol {
            margin: 0;
            padding-left: 10px;
        }
    </style>
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title" id="judul_header">
                    DATA NILAI RAPOR PESERTA
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
                                        <span class="label text-end" style="flex: 1;">Rapor</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="rapor" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Jenjang</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="jenjang" style="flex: 1;">-</span>
                                    </div>
                                </div>
                                <div class="col-md-4 profile">
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Nama</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="siswa" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Kelas</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="kelas" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Pembimbing</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="pembimbing" style="flex: 1;">-</span>
                                    </div>
                                </div>
                                <div class="col-md-4 profile">
                                    <div class="text-center">
                                        <img alt="Peserta" id="avatarImg" src=""
                                            class="rounded-circle img-responsive" width="100" height="100" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-4 profile ">
                                    <span class="mb-3 d-flex justify-content-center" >NILAI BIDANG STUDI</span>
                                    <!-- tahfidz -->
                                    <div class="bidang-studi-view-baru">
                                        <div class="profile-item  mb-3 d-flex justify-content-between" >
                                            <span class="label text-end" style="flex: 1;">Nilai Al Qur'an</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="alquran" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item  mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Aqidah</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="aqidah" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item  mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Ibadah</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="ibadah" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Tazkiyatun Nafs</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="tazkiyatun" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Hadits</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="hadits" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Sirah</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="sirah" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Fikrul Islam</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="fikrul" style="flex: 1;">-</span>
                                        </div>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Rata-Rata Nilai</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="rata_rata" style="flex: 1;">-</span>
                                    </div>
                                </div>

                                <div class="col-md-4 profile">
                                    <span class="mb-3 d-flex justify-content-center" >NILAI KARAKTER</span>
                                    <div class="karakter-view-lama">
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Aqidah yang lurus</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="aqdh" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Ibadah yang benar</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="ibdh" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Kepribadian yang matang dan berakhlak mulia</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="akhlak" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Pribadi yang sungguh-sungguh, disiplin dan mampu mengendalikan diri</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="prbd" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Mampu membaca, menghafal, dan memahami Al-Qur’an</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="aqr" style="flex: 1;">-</span>
                                        </div>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Nilai Berwawasan luas</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="wwsn" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Nilai Karya Wisata/Tafakur Alam </span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="kwta" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Nilai Perkemahan</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="perkemahan" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Nilai Malam Bina Iman dan Taqwa</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="mbit" style="flex: 1;">-</span>
                                    </div>
                                </div>

                                <div class="col-md-4 profile">
                                    <span class="mb-3 d-flex justify-content-center" >NILAI AKTIVITAS AMAL</span>
                                    <div class="amal-tahfidz">
                                        <div class="profile-item mb-3 d-flex justify-content-between" id="n_k_p">
                                            <span class="label text-end" style="flex: 1;">Nilai Shalat wajib 5 Waktu berjamaah (putra: di masjid) (tepat waktu untuk putri)</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="sholat_wajib" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between" id="n_m_p">
                                            <span class="label text-end" style="flex: 1;">Nilai Tilawah  Al-Qur'an</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="tilawah" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between" id="n_t_p">
                                            <span class="label text-end" style="flex: 1;">Nilai Shalat Tahajud/Qiyamul Lail</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="tahajud" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between" id="n_th_p">
                                            <span class="label text-end" style="flex: 1;">Nilai Shalat Dhuha</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="duha" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between" id="n_tf_p">
                                            <span class="label text-end" style="flex: 1;">Nilai Shalat Rawatib</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="rawatib" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between" id="n_jk_p">
                                            <span class="label text-end" style="flex: 1;">Nilai Dzikir Pagi/Sore</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="dzikri" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Puasa Sunah</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="puasa" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Infaq</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="infaq" style="flex: 1;">-</span>
                                        </div>
                                    </div>  
                                </div>

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
        var id = '{{ $id }}';
        var peserta = '{{ $peserta }}';
        var periode = '{{ $periode }}';
        var jenjang = '{{ $jenjang }}';
        var tahun = '{{ $tahun }}';
        
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function getRating(rata_baru) {
            if (rata_baru == null) {
                return "Belum Dinilai";
            }
            if(rata_baru >= 96 && rata_baru <= 100){
                return "Sangat Baik";
            }else if(rata_baru >= 86 && rata_baru <=95){
                return "Baik";
            }else if(rata_baru >= 80 && rata_baru <= 85){
                return "Cukup";
            }else {
                return "Kurang";
            }
        }

        function getRatingKhatam(rata_baru) {
            if(rata_baru >= 5){
                return "Sangat Baik";
            }else if(rata_baru >= 1 && rata_baru <= 4){
                return "Baik";
            }else {
                return "Kurang";
            }
        }

        function formatValue(value, decimals) {
            if (value === null) return '-'; // Handle null or undefined values
            return value.toFixed(decimals);
        }

        function getAmal(rata_baru) {
            if (rata_baru === null || typeof rata_baru === 'undefined') {
                return "Belum Dinilai";
            }
            if(rata_baru >= 20 && rata_baru <= 100){
                return "Sangat Baik";
            }else if(rata_baru >= 11 && rata_baru <=20){
                return "Baik";
            }else if(rata_baru >= 1 && rata_baru <= 10){
                return "Cukup";
            }else {
                return "Kurang";
            }
        }

        // Helper function to format value with a rating
        function formatValue(value, decimalPlaces) {
            return value != null ? parseFloat(value).toFixed(decimalPlaces) : '00.00';
        }

        function formatRataLama(value, rating) {
            return value != null ? formatValue(value, 2) + " ( " + rating + " )" : '00.00';
        }

        function formatRataLamaAmal(value, rating) {
            return value != null ? formatValue(value, 0) + " ( " + rating + " )" : '00';
        }

        $(document).ready(function() {
        // Fetch participant details via AJAX
            $.ajax({
                url: `{{ url('guru/penilaian_rapor_pbi/ajax_detail_peserta') }}/${id}/${peserta}/${tahun}/${jenjang}/${periode}`,
                type: 'GET',
                success: function(respons) {
                    const data = respons.data;
                    
                    // Update identity-related fields
                    const defaultImg = '{{ asset('assets/admin/img/avatars/avatar.jpg') }}';
                    $('#tahun_ajaran').text(capitalizeFirstLetter((data.nama_tahun_ajaran || '').toUpperCase()));
                    $('#rapor').text('BINA PRIBADI ISLAM (BPI)');
                    $('#pembimbing').text(capitalizeFirstLetter((data.nama_guru || '').toUpperCase()));
                    $('#siswa').text(capitalizeFirstLetter((data.nama_siswa || '').toUpperCase()));
                    $('#kelas').text(capitalizeFirstLetter((data.nama_kelas || '').toUpperCase()));
                    $('#jenjang').text(capitalizeFirstLetter((data.jenis_kegiatan || '').toUpperCase()));
                    $('#avatarImg').attr('src', data.foto_siswa ? `{{ url('storage') }}/${data.foto_siswa}` : defaultImg);

                    // Update Tahfidz report
                    const rataBaru = [
                        data.alquran, data.aqidah, data.ibadah, data.hadits, 
                        data.sirah, data.tazkiyatun, data.fikrul
                    ].reduce((sum, val) => sum + (val || 0), 0) / 7;

                    $('#rata_rata').text(`${rataBaru.toFixed(2)} ( ${getRating(rataBaru)} )`);

                    ['alquran', 'aqidah', 'ibadah', 'hadits', 'sirah', 'tazkiyatun', 'fikrul'].forEach(field => {
                        $(`#${field}`).text((data[field] || 0).toFixed(2));
                    });

                    // Update other ratings
                    ['aqdh', 'ibdh', 'akhlak', 'prbd', 'aqr', 'wwsn','kwta', 'perkemahan', 'mbit'].forEach(field => {
                        $(`#${field}`).text(formatRataLama(data[field], getRating(data[field])));
                    });

                    // Update Amal fields
                    ['sholat_wajib', 'tilawah', 'tahajud', 'duha', 'rawatib', 'dzikri', 'puasa', 'infaq'].forEach(field => {
                        $(`#${field}`).text(formatRataLamaAmal(data[field], getAmal(data[field])));
                    });
                },
                error: function(xhr, status, error) {
                    console.error(`AJAX Error: ${status} ${error}`);
                }
            });
        });

    </script>
@endsection
