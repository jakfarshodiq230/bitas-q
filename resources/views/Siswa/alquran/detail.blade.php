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
                    DETAIL PENILAIAN RAPOR PESERTA AL-QUR'AN
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
                                    <span class="mb-3 d-flex justify-content-center" >HAFALAN BARU</span>
                                    <!-- tahfidz -->
                                    <div class="tahfidz-view-baru">
                                        <div class="profile-item  mb-3 d-flex justify-content-between" >
                                            <span class="label text-end" style="flex: 1;">Nilai Tajwid</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_j_baru" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item  mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Fasohah</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_f_baru" style="flex: 1;">-</span>
                                        </div>
                                    </div>
                                    <!-- tahsin -->
                                    <div class="tahsin-view-baru">
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Gunnah</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_g_baru" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Mad</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_m_baru" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Waqaf</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_w_baru" style="flex: 1;">-</span>
                                        </div>
                                    </div>
                                    

                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Nilai Kelancaran</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="n_k_baru" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Rata-Rata Nilai</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="rata_baru" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Surah</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="surah_baru" style="flex: 1;">-</span>
                                    </div>
                                </div>
                                <div class="col-md-4 profile">
                                    <span class="mb-3 d-flex justify-content-center" >HAFALAN LAMA</span>
                                    <div class="tahfidz-view-lama">
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Tajwid</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_j_lama" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Fasohah</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_f_lama" style="flex: 1;">-</span>
                                        </div>
                                    </div>
                                    <!-- tahsin -->
                                    <div class="tahsin-view-lama">
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Gunnah</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_g_lama" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Mad</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_m_lama" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Waqaf</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_w_lama" style="flex: 1;">-</span>
                                        </div>
                                    </div>

                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Nilai Kelancaran</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="n_k_lama" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Rata-Rata Nilai</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="rata_lama" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Surah</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="surah_lama" style="flex: 1;">-</span>
                                    </div>
                                </div>
                                <div class="col-md-4 profile">
                                    <span class="mb-3 d-flex justify-content-center" >NILAI PENGEMBANGAN DIRI</span>
                                    <div class="pengmbangan-tahfidz">
                                        <div class="profile-item mb-3 d-flex justify-content-between" id="n_k_p">
                                            <span class="label text-end" style="flex: 1;">Nilai Keaktifan dan Kedisiplinan</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_k" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between" id="n_m_p">
                                            <span class="label text-end" style="flex: 1;">Nilai Murojaah Hafalan Mandiri</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_m" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between" id="n_t_p">
                                            <span class="label text-end" style="flex: 1;">Nilai Tilawah Al-Quran Mandiri</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_t" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between" id="n_th_p">
                                            <span class="label text-end" style="flex: 1;">Nilai Tahsin Al-Qur'an</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_th" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between" id="n_tf_p">
                                            <span class="label text-end" style="flex: 1;">Nilai Tarjim / Tafhim Al-Quran</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_tf" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between" id="n_jk_p">
                                            <span class="label text-end" style="flex: 1;">Nilai Jumlah Khatam Al-Qur'an</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_jk" style="flex: 1;">-</span>
                                        </div>
                                    </div>
                                    <div class="pengmbangan-tahsin">
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Keaktifan dan Kedisiplinan</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_k_th" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Tahsin Al-Qur'an</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_th_th" style="flex: 1;">-</span>
                                        </div>
                                        <div class="profile-item mb-3 d-flex justify-content-between">
                                            <span class="label text-end" style="flex: 1;">Nilai Jumlah Khatam Al-Qur'an</span>
                                            <span class="separator">:</span>
                                            <span class="value text-start" id="n_jk_th" style="flex: 1;">-</span>
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

        $(".tahsin-view-baru").hide();
        $(".tahfidz-view-baru").hide();

        $(".tahsin-view-lama").hide();
        $(".tahfidz-view-lama").hide();

        $(".pengmbangan-tahfidz").hide();
        $(".pengmbangan-tahsin").hide();
        
        $(document).ready(function() {
     
            $.ajax({
                url: '{{ url('siswa/kegiatan/ajax-nilai') }}/' + periode,
                type: 'GET',
                success: function(respons) {
                    // Update the HTML elements with basic info
                    updateIdentitas(respons.data);
                    
                    // Check for jenis_kegiatan and handle accordingly
                    if (respons.data.jenis_kegiatan === 'tahfidz') {
                        handleTahfidz(respons.data);
                    } else {
                        handleTahsin(respons.data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });

            function updateIdentitas(data) {
                $('#tahun_ajaran').text(capitalizeFirstLetter((data.nama_tahun_ajaran || '').toUpperCase()));
                $('#rapor').text(capitalizeFirstLetter((data.jenis_periode || '').toUpperCase()));
                $('#pembimbing').text(capitalizeFirstLetter((data.nama_guru || '').toUpperCase()));
                $('#siswa').text(capitalizeFirstLetter((data.nama_siswa || '').toUpperCase()));
                $('#kelas').text(capitalizeFirstLetter((data.nama_kelas || '').toUpperCase()));
                $('#jenjang').text(capitalizeFirstLetter((data.jenis_kegiatan || '').toUpperCase()));

                // Update avatar image
                var fotoSiswaUrl = data.foto_siswa ? "{{ url('storage') }}/" + data.foto_siswa : '{{ asset('assets/admin/img/avatars/avatar.jpg') }}';
                $('#avatarImg').attr('src', fotoSiswaUrl);
            }

            function handleTahfidz(data) {
                $(".pengmbangan-tahfidz").show();

                // Calculate and update values for new Tahfidz
                var rata_baru = calculateAverage([data.n_j_baru, data.n_f_baru, data.n_k_baru]);
                updateTahfidzValues('baru', rata_baru, data.surah_baru);

                // Calculate and update values for old Tahfidz
                var rata_lama = calculateAverage([data.n_j_lama, data.n_f_lama, data.n_k_lama]);
                updateTahfidzValues('lama', rata_lama, data.surah_lama);

                // Show specific elements
                $(".tahfidz-view-baru, .tahfidz-view-lama").show();
                updatePengembanganDiri(data);
            }

            function handleTahsin(data) {
                $(".pengmbangan-tahsin").show();

                // Calculate and update values for new Tahsin
                var rata_baru = calculateAverage([data.n_g_baru, data.n_m_baru, data.n_w_baru, data.n_k_baru]);
                updateTahsinValues('baru', rata_baru, data.surah_baru);

                // Calculate and update values for old Tahsin
                var rata_lama = calculateAverage([data.n_g_lama, data.n_m_lama, data.n_w_lama, data.n_k_lama]);
                updateTahsinValues('lama', rata_lama, data.surah_lama);

                // Show specific elements
                $(".tahsin-view-baru, .tahsin-view-lama").show();
                updatePengembanganDiri(data);
            }

            function calculateAverage(values) {
                var validValues = values.map(v => parseFloat(v) || 0);
                var total = validValues.reduce((acc, val) => acc + val, 0);
                return (total / validValues.length).toFixed(2);
            }

            function updateTahfidzValues(type, rata, surah) {
                var rating = getRating(rata);
                $('#rata_' + type).text(rata + " ( " + rating + " )");

                var $target = $('#surah_' + type);
                $target.empty();
                if (surah && surah.trim() !== '') {
                    var surahArray = surah.split(',').map(s => $('<li>').text(s.trim()));
                    $target.append($('<ol>').append(surahArray));
                } else {
                    $target.text('0');
                }
            }

            function updateTahsinValues(type, rata, surah) {
                var rating = getRating(rata);
                $('#rata_' + type).text(rata + " ( " + rating + " )");

                var $target = $('#surah_' + type);
                $target.empty();
                if (surah && surah.trim() !== '') {
                    var surahArray = surah.split(',').map(s => $('<li>').text(s.trim()));
                    $target.append($('<ol>').append(surahArray));
                } else {
                    $target.text('0');
                }
            }

            function updatePengembanganDiri(data) {
                $('#n_k').text(formatRating(data.n_k_p));
                $('#n_m').text(formatRating(data.n_m_p));
                $('#n_t').text(formatRating(data.n_t_p));
                $('#n_th').text(formatRating(data.n_th_p));
                $('#n_tf').text(formatRating(data.n_tf_p));
                $('#n_jk').text(formatRating(data.n_jk_p));
            }

            function formatRating(value) {
                return value ? value.toFixed(2) + " ( " + getRating(value) + " )" : '00.00';
            }

            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            function getRating(rata_baru) {
                if(rata_baru >= 96 && rata_baru <= 100){
                    return "Sangat Baik";
                }else if(rata_baru >= 86 && rata_baru <=95){
                    return "Baik";
                }else if(rata_baru >= 80 && rata_baru <= 85){
                    return "Cukup";
                }else{
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
        });

    </script>
@endsection
