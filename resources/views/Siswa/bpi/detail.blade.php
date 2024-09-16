@extends('Siswa.layout')
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
        var periode = '{{ $periode }}';
        
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
            if (rata_baru == null) {
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

        $(document).ready(function() {
            // identitas
            $.ajax({
                url: '{{ url('siswa/bpi/ajax-nilai') }}/' + periode,
                type: 'GET',
                success: function(respons) {
                   // Ensure data.periode and its properties exist
                    var nama_tahun_ajaran = respons.data.nama_tahun_ajaran || '';
                    var jenis_kegiatan = respons.data.jenis_periode || '';
                    var nama_guru = respons.data.nama_guru || '';
                    var nama_siswa = respons.data.nama_siswa || '';
                    var nama_kelas = respons.data.nama_kelas || '';
                    var jenjang = respons.data.jenis_kegiatan || '';

                    // Update the HTML elements
                    $('#tahun_ajaran').text(capitalizeFirstLetter(nama_tahun_ajaran.toUpperCase()));
                    $('#rapor').text('BINA PRIBADI ISLAM (BPI)');
                    $('#pembimbing').text(capitalizeFirstLetter(nama_guru.toUpperCase()));
                    $('#siswa').text(capitalizeFirstLetter(nama_siswa.toUpperCase()));
                    $('#kelas').text(capitalizeFirstLetter(nama_kelas.toUpperCase()));
                    $('#jenjang').text(capitalizeFirstLetter(jenjang.toUpperCase()));
                    if (respons.data.foto_siswa != null) {
                        var fotoSiswaUrl = "{{ url('storage') }}/" + respons.data.foto_siswa;
                        $('#avatarImg').attr('src', fotoSiswaUrl);
                    } else {
                        var fotoSiswaUrl = '{{ asset('assets/admin/img/avatars/avatar.jpg') }}'
                        $('#avatarImg').attr('src', fotoSiswaUrl);
                    }
                    
                        // rapor tahfidz baru
                        var alquran = respons.data.alquran || 0;
                        var aqidah = respons.data.aqidah || 0;
                        var ibadah = respons.data.ibadah || 0;
                        var hadits = respons.data.hadits || 0;
                        var sirah = respons.data.sirah || 0;
                        var tazkiyatun = respons.data.tazkiyatun || 0;
                        var fikrul = respons.data.fikrul || 0;

                        var rata_baru = (alquran+aqidah+ibadah+hadits+sirah+tazkiyatun+fikrul)/7;
                        var rating_baru = getRating(rata_baru);

                        var rata_baru_rounded = rata_baru.toFixed(2) + " ( " + rating_baru + " )";
                        var surah_baru = respons.data.surah_baru || 0;

                        $('#alquran').text( parseFloat(alquran).toFixed(2) );
                        $('#aqidah').text( parseFloat(aqidah).toFixed(2) );
                        $('#ibadah').text( parseFloat(ibadah).toFixed(2) );
                        $('#hadits').text( parseFloat(hadits).toFixed(2) );
                        $('#sirah').text( parseFloat(sirah).toFixed(2) );
                        $('#tazkiyatun').text( parseFloat(tazkiyatun).toFixed(2) );
                        $('#fikrul').text( parseFloat(fikrul).toFixed(2) );
                        $('#rata_rata').text( rata_baru_rounded );


                        // nilai karakter
                        var rating_aqdh = getRating(respons.data.aqdh);
                        var rata_lama_aqdh = formatValue(respons.data.aqdh, 2) + " ( " + rating_aqdh + " )";
                        $('#aqdh').text(rating_aqdh !== null ? rata_lama_aqdh : '00.00');

                        var rating_ibdh = getRating(respons.data.ibdh);
                        var rata_lama_ibdh = formatValue(respons.data.ibdh, 2) + " ( " + rating_ibdh + " )";
                        $('#ibdh').text(rating_ibdh !== null ? rata_lama_ibdh : '00.00');

                        var rating_akhlak = getRating(respons.data.akhlak);
                        var rata_lama_akhlak = formatValue(respons.data.akhlak, 2) + " ( " + rating_akhlak + " )";
                        $('#akhlak').text(rating_akhlak !== null ? rata_lama_akhlak : '00.00');

                        var rating_prbd = getRating(respons.data.prbd);
                        var rata_lama_prbd= formatValue(respons.data.prbd, 2) + " ( " + rating_prbd + " )";
                        $('#prbd').text(rating_prbd !== null ? rata_lama_prbd : '00.00');

                        var rating_aqr = getRating(respons.data.aqr);
                        var rata_lama_aqr= formatValue(respons.data.aqr, 2) + " ( " + rating_aqr + " )";
                        $('#aqr').text(rating_aqr!== null ? rata_lama_aqr : '00.00');

                        var rating_wwsn = getRating(respons.data.wwsn);
                        var rata_lama_wwsn= formatValue(respons.data.wwsn, 2) + " ( " + rating_wwsn + " )";
                        $('#wwsn').text(rating_wwsn!== null ? rata_lama_wwsn : '00.00');


                        // nilai aktivitas amal
                        var rating_sholat_wajib= getAmal(respons.data.sholat_wajib);
                        var rata_lama_sholat_wajib = respons.data.sholat_wajib + " ( " + rating_sholat_wajib + " )";
                        $('#sholat_wajib').text(rating_sholat_wajib !== null ? rata_lama_sholat_wajib : '00.00');

                        var rating_tilawah= getAmal(respons.data.tilawah);
                        var rata_lama_tilawah = respons.data.tilawah + " ( " + rating_tilawah+ " )";
                        $('#tilawah').text(rating_tilawah !== null ? rata_lama_tilawah : '00.00');

                        var rating_tahajud= getAmal(respons.data.tahajud);
                        var rata_lama_tahajud= respons.data.tahajud + " ( " + rating_tahajud+ " )";
                        $('#tahajud').text(rating_tahajud !== null ? rata_lama_tahajud : '00.00');

                        var rating_duha= getAmal(respons.data.duha);
                        var rata_lama_duha= respons.data.duha + " ( " + rating_duha+ " )";
                        $('#duha').text(rating_duha !== null ? rata_lama_duha : '00.00');

                        var rating_rawatib= getAmal(respons.data.rawatib);
                        var rata_lama_rawatib= respons.data.rawatib + " ( " + rating_rawatib+ " )";
                        $('#rawatib').text(rating_rawatib!== null ? rata_lama_rawatib: '00.00');

                        var rating_dzikri= getAmal(respons.data.dzikri);
                        var rata_lama_dzikri= respons.data.dzikri+ " ( " + rating_dzikri+ " )";
                        $('#dzikri').text(rating_dzikri!== null ? rata_lama_dzikri: '00.00');

                        var rating_puasa= getAmal(respons.data.puasa);
                        var rata_lama_puasa= respons.data.puasa + " ( " + rating_puasa+ " )";
                        $('#puasa').text(rating_puasa!== null ? rata_lama_puasa: '00.00');

                        var rating_infaq= getAmal(respons.data.infaq);
                        var rata_lama_infaq= respons.data.infaq+ " ( " + rating_infaq+ " )";
                        $('#infaq').text(rating_infaq!== null ? rata_lama_infaq: '00.00');

                 
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });
        });
    </script>
@endsection
