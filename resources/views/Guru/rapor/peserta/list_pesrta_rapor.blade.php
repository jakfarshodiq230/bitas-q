@extends('Admin.layout')
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
    </style>
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title" id="judul_header">
                    Data Penilaian Rapor Peserta
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
                                        <span class="value text-start" id="tahun_ajaran" style="flex: 1;">Andi</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Rapor</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="rapor" style="flex: 1;">Andi</span>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4 profile">
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Jenjang</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="jenjang" style="flex: 1;">Andi</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Tanggal</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="tanggal" style="flex: 1;">Andi</span>
                                    </div>
                                </div>
                                <div class="col-md-4 profile">
                                    <div class="profile-item mb-3 d-flex justify-content-center">
                                        <button class="btn btn-outline-primary me-2 addBtn text-end"
                                            id="addBtn">Penilaian Pengembangan Diri
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" id="tahfidz">
                        <div class="card-body">
                            <table id="datatables-ajax" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Surah</th>
                                        <th>Keaktifan dan Kedisiplinan</th>
                                        <th>Murojaah Hafalan Mandiri</th>
                                        <th>Tilawah Mandiri</th>
                                        <th>Tahsin</th>
                                        <th>Tarjim / Tafhim</th>
                                        <th>Jumlah Khatam</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <th>No.</th>
                                        <th>Nama</th>
                                        <th>Surah</th>
                                        <th>Keaktifan dan Kedisiplinan</th>
                                        <th>Murojaah Hafalan Mandiri</th>
                                        <th>Tilawah Mandiri</th>
                                        <th>Tahsin</th>
                                        <th>Tarjim / Tafhim</th>
                                        <th>Jumlah Khatam</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>

                    {{-- add atau edit guru --}}
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
                                                    <label>Siswa</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="siswa_penilaian" data-bs-toggle="select2" required>
                                                        <option>PILIH</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Surah Awal Hafalan Baru</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="awal_surah_baru" data-bs-toggle="select2"
                                                        required>
                                                        <option>PILIH</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Surah Akhir Hafalan Baru</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="akhir_surah_baru" data-bs-toggle="select2"
                                                        required>
                                                        <option>PILIH</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Surah Awal Hafalan Lama</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="awal_surah_lama" data-bs-toggle="select2"
                                                        required>
                                                        <option>PILIH</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Surah Akhir Hafalan Lama</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="akhir_surah_lama" data-bs-toggle="select2"
                                                        required>
                                                        <option>PILIH</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>NiLai Keaktifan dan Kedisiplinan</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="n_k_p_k" data-bs-toggle="select2"
                                                        onchange="handleNilaiChange(this, $('input[name=\'n_k_p\']'))"
                                                        required>
                                                        <option>PILIH</option>
                                                        @foreach (range(1, 100) as $angka)
                                                            <option value="{{ $angka }}">{{ $angka }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nilai Murojaah Hafalan Mandiri</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="n_m_p_k" data-bs-toggle="select2"
                                                        onchange="handleNilaiChange(this, $('input[name=\'n_m_p\']'))"
                                                        required>
                                                        <option>PILIH</option>
                                                        @foreach (range(1, 100) as $angka)
                                                            <option value="{{ $angka }}">{{ $angka }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nilai Tilawah Al-Quran Mandiri</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="n_t_p_k" data-bs-toggle="select2"
                                                        onchange="handleNilaiChange(this, $('input[name=\'n_t_p\']'))"
                                                        required>
                                                        <option>PILIH</option>
                                                        @foreach (range(1, 100) as $angka)
                                                            <option value="{{ $angka }}">{{ $angka }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nilai Tahsin Al-Qur'an</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="n_th_p_k" data-bs-toggle="select2"
                                                        onchange="handleNilaiChange(this, $('input[name=\'n_th_p\']'))"
                                                        required>
                                                        <option>PILIH</option>
                                                        @foreach (range(1, 100) as $angka)
                                                            <option value="{{ $angka }}">{{ $angka }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nilai Tarjim / Tafhim Al-Quran</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="n_tf_p_k" data-bs-toggle="select2"
                                                        onchange="handleNilaiChange(this, $('input[name=\'n_tf_p\']'))"
                                                        required>
                                                        <option>PILIH</option>
                                                        @foreach (range(1, 100) as $angka)
                                                            <option value="{{ $angka }}">{{ $angka }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Jumlah Khatam Al-Qur'an</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="n_jk_p_k" data-bs-toggle="select2"
                                                        onchange="handleNilaiChange(this, $('input[name=\'n_jk_p\']'))"
                                                        required>
                                                        <option>PILIH</option>
                                                        @foreach (range(1, 100) as $angka)
                                                            <option value="{{ $angka }}">{{ $angka }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Tanggal Penilaian</label>
                                                    <input type="date" name="tggl_penilaian_p"
                                                        class="form-control" placeholder="Tanggal Penilaian" required>
                                                </div>
                                            </div>
                                            <div class="col-6 col-lg-6">
                                                <div class="mb-3">
                                                    <label>Kelas</label>
                                                    <input type="text" name="kelas" id="kelas"
                                                        class="form-control" placeholder="Kelas" readonly>
                                                    <input type="text" name="id_kelas" id="id_kelas"
                                                        class="form-control" placeholder="id_kelas" hidden>
                                                    <input type="text" name="id_siswa"
                                                        id="id_siswa" class="form-control"
                                                        placeholder="id_siswa" hidden>
                                                    <input type="text" name="id_rapor"
                                                        id="id_rapor" class="form-control"
                                                        placeholder="id_rapor" hidden>
                                                    <input type="text" name="id_tahun_ajaran"
                                                        id="id_tahun_ajaran" class="form-control"
                                                        placeholder="id_tahun_ajaran" value="{{ $tahun}}" hidden>
                                                    <input type="text" name="id_periode"
                                                        id="id_periode" class="form-control"
                                                        placeholder="id_periode" value="{{ $periode}}" hidden>
                                                    <input type="text" name="id_guru"
                                                        id="id_guru" class="form-control"
                                                        placeholder="id_guru" hidden>
                                                    <input type="text" name="jenis_penilaian_kegiatan"
                                                        id="jenis_penilaian_kegiatan" class="form-control"
                                                        placeholder="jenis_penilaian_kegiatan" value="{{ $jenjang}}" hidden>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Ayat Awal Hafalan Baru</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="awal_ayat_baru" data-bs-toggle="select2"
                                                        required>
                                                        <option>PILIH</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Ayat Akhir Hafalan Baru</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="akhir_ayat_baru" data-bs-toggle="select2"
                                                        required>
                                                        <option>PILIH</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Ayat Awal Hafalan Lama</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="awal_ayat_lama" data-bs-toggle="select2"
                                                        required>
                                                        <option>PILIH</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Ayat Akhir Hafalan Lama</label>
                                                    <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="akhir_ayat_lama" data-bs-toggle="select2"
                                                        required>
                                                        <option>PILIH</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="n_k_p">NiLai Keaktifan dan Kedisiplinan</label>
                                                    <input type="text" class="form-control" name="n_k_p" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="n_m_p">Nilai Murojaah Hafalan Mandiri</label>
                                                    <input type="text" class="form-control" name="n_m_p" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="n_t_p">Nilai Tilawah Al-Quran Mandiri</label>
                                                    <input type="text" class="form-control" name="n_t_p" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="n_th_p">Nilai Tahsin Al-Qur'an</label>
                                                    <input type="text" class="form-control" name="n_th_p" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="n_tf_p">Hasil Jumlah Khatam Al-Qur'an</label>
                                                    <input type="text" class="form-control" name="n_tf_p" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="n_jk_p">Hasil Jumlah Khatam Al-Qur'an</label>
                                                    <input type="text" class="form-control" name="n_jk_p" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Keterangan</label>
                                                    <textarea name="ketrangan_p" class="form-control" placeholder="Keterangan" required></textarea>
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
                    {{-- end add atau edit guru --}}
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <!-- Your other content -->
    <script>
        $('#dataForm')[0].reset();
        var periode = '{{ $periode }}';
        var jenjang = '{{ $jenjang }}';
        var tahun = '{{ $tahun }}';
        var guru = "GR-230624-3";

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function handleNilaiChange(selectElement, inputElement) {
            const selectedValue = parseFloat(selectElement.value);
            let ktr_p;

            if (selectedValue >= 80) {
                ktr_p = "Sangat Baik"; // very good
            } else if (selectedValue >= 60) {
                ktr_p = "Baik"; // good
            } else if (selectedValue >= 40) {
                ktr_p = "Buruk"; // bad
            } else {
                ktr_p = "Sangat Buruk"; // very bad
            }

            $(inputElement).val(ktr_p);
        }

        // ajax
        $(document).ready(function() {
            $.ajax({
                url: '{{ url('guru/penilaian_rapor/ajax_list_peserta') }}/' + tahun + '/' + jenjang + '/' + periode,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    var select = $('select[name="siswa_penilaian"]');
                    select.empty().append('<option value="">PILIH</option>');

                    $.each(data.peserta, function(key, value) {
                        select.append('<option value="' + value.id_siswa + '">' + 
                            value.nama_siswa.trim().toUpperCase() + ' [ ' + value.nisn_siswa + ' ]' + 
                            '</option>');
                    });

                    select.change(function() {
                        var selectedId = $(this).val();
                        var selectedSiswa = data.peserta.find(function(peserta) {
                            return peserta.id_siswa == selectedId;
                        });

                        if (selectedSiswa) {
                            $('#kelas').val(selectedSiswa.nama_kelas.trim().toUpperCase());
                            $('#id_kelas').val(selectedSiswa.id_kelas);
                            $('#id_siswa').val(selectedSiswa.id_siswa);
                            $('#id_guru').val(selectedSiswa.id_guru);
                            $('#id_rapor').val(selectedSiswa.id_rapor);
                            
                            // Update the surah baru select
                            updateSurahBaru(selectedSiswa.surah_baru, data.surah, 'awal_surah_baru', 'verseCount', 'awal_ayat_baru');
                            updateSurahBaru(selectedSiswa.surah_baru, data.surah, 'akhir_surah_baru', 'verseCount', 'akhir_ayat_baru');

                            updateSurahBaru(selectedSiswa.surah_lama, data.surah, 'awal_surah_lama', 'verseCount', 'awal_ayat_lama');
                            updateSurahBaru(selectedSiswa.surah_lama, data.surah, 'akhir_surah_lama', 'verseCount', 'akhir_ayat_lama');
                        } else {
                            $('#kelas').val('');
                            $('#id_kelas').val('');
                            $('#id_siswa').val('');
                            $('#id_guru').val('');
                            $('#id_rapor').val('');
                            
                            $('select[name="awal_surah_baru"]').empty().append('<option>PILIH</option>');
                            $('select[name="akhir_surah_baru"]').empty().append('<option>PILIH</option>');
                            $('select[name="awal_ayat_baru"]').empty().append('<option>PILIH</option>');
                            $('select[name="akhir_ayat_baru"]').empty().append('<option>PILIH</option>');

                            $('select[name="awal_surah_lama"]').empty().append('<option>PILIH</option>');
                            $('select[name="akhir_surah_lama"]').empty().append('<option>PILIH</option>');
                            $('select[name="awal_ayat_lama"]').empty().append('<option>PILIH</option>');
                            $('select[name="akhir_ayat_lama"]').empty().append('<option>PILIH</option>');
                        }
                    });
                }
            });


            function updateSurahBaru(listSurahBaru, surahData, selectSurahBaruName, verseCountElementId, selectAyatAwalName) {
                var selectSurahBaru = $('select[name="' + selectSurahBaruName + '"]');
                selectSurahBaru.empty().append('<option value="">PILIH</option>');

                var siswaArray = listSurahBaru.split(',');
                $.each(siswaArray, function(key, value) {
                    selectSurahBaru.append('<option value="' + value + '">' + 
                        value.trim().toUpperCase() + 
                        '</option>');
                });

                // Handle verse count when a surah is selected
                selectSurahBaru.change(function() {
                    var selectedSurah = $(this).val();
                    if (selectedSurah) {
                        displayVerseCount(selectedSurah, surahData, verseCountElementId, selectAyatAwalName);
                    } else {
                        $('#' + verseCountElementId).text(''); // Clear verse count if no surah is selected
                    }
                });
            }

            function displayVerseCount(selectedSurah, surahData, verseCountElementId, selectAyatAwalName) {
                var verseCountElement = $('#' + verseCountElementId);
                var surah = surahData.find(s => s.namaLatin === selectedSurah);
                var selectAyatAwal = $('select[name="' + selectAyatAwalName + '"]');
                selectAyatAwal.empty().append('<option value="">PILIH</option>');

                for (let index = 0; index <= surah.jumlahAyat; index++) {
                    selectAyatAwal.append('<option value="' + index + '">' + 
                        (index ) + // Display verse numbers starting from 1
                        '</option>');
                }
            }


        });

        //datatable
        $(document).ready(function() {
            // identitas
            $.ajax({
                url: '{{ url('guru/penilaian_rapor/ajax_list_peserta') }}/' + tahun + '/' + jenjang + '/' + periode,
                type: 'GET',
                success: function(data) {
                   // Ensure data.periode and its properties exist
                    var periode = data.periode || {};
                    var nama_tahun_ajaran = periode.nama_tahun_ajaran || '';
                    var jenis_kegiatan = periode.jenis_periode || '';
                    var jenis_periode = periode.jenis_periode || '';
                    var jenis_jenjang = periode.jenis_kegiatan || '';
                    var tanggal = periode.tggl_periode || '';

                    // Update the HTML elements
                    $('#tahun_ajaran').text(capitalizeFirstLetter(nama_tahun_ajaran));
                    $('#rapor').text(capitalizeFirstLetter(jenis_kegiatan));
                    $('#tanggal').text(capitalizeFirstLetter(tanggal));
                    $('#jenjang').text(capitalizeFirstLetter(jenis_jenjang));
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });

            // menampilkan data
            $('#datatables-ajax').DataTable({
                processing: true,
                serverSide: false,
                retrieve: false,
                destroy: true,
                responsive: true,
                ajax: {
                        url: '{{ url('guru/penilaian_rapor/ajax_list_peserta') }}/' +tahun+'/'+jenjang+'/'+periode,
                        dataSrc: 'nilai' // Specify the data source as 'nilai'
                    },
                columns: [{
                        "data": null,
                        "name": "rowNumber",
                        "render": function(data, type, row, meta) {
                            return meta.row +
                                1;
                        }
                    },
                    {
                        data: 'nama_siswa',
                        name: 'nama_siswa',
                        render: function(data, type, row) {
                            return 'Nama : '+row.nama_siswa.trim().toUpperCase() +
                            '<br> Kelas : '+ row.nama_kelas.trim().toUpperCase();
                        }
                    },
                    {
                        data: null,
                        name: null,
                        render: function(data, type, row) {
                            const awal_surah_baru = row.awal_ayat_baru === 0 ? row.awal_surah_baru : row.awal_surah_baru + ' [' + row.awal_ayat_baru + ']';
                            const akhir_surah_baru = row.akhir_ayat_baru === 0 ? row.akhir_surah_baru : row.akhir_surah_baru + ' [' + row.akhir_ayat_baru + ']';

                            const awal_surah_lama = row.awal_ayat_lama === 0 ? row.awal_surah_lama : row.awal_surah_lama + ' [' + row.awal_ayat_lama + ']';
                            const akhir_surah_lama = row.akhir_ayat_lama === 0 ? row.akhir_surah_lama : row.akhir_surah_lama + ' [' + row.akhir_ayat_lama + ']';

                            const ktr =  row.awal_surah_baru === null ? '-' : 'Hafalan Baru: ' + awal_surah_baru + ' S/d ' + akhir_surah_baru + '<br>Hafalan Lama: ' + awal_surah_lama + ' S/d ' + akhir_surah_lama;

                            return ktr;
                        }

                    },
                    {
                        data: 'n_k_p',
                        name: 'n_k_p',
                        render: function(data, type, row) {
                            return row.n_k_p || 0;
                        }
                    },
                    {
                        data: 'n_m_p',
                        name: 'n_m_p',
                        render: function(data, type, row) {
                            return row.n_m_p || 0;
                        }
                    },
                    {
                        data: 'n_t_p',
                        name: 'n_t_p',
                        render: function(data, type, row) {
                            return row.n_t_p || 0;
                        }
                    },
                    {
                        data: 'n_th_p',
                        name: 'n_th_p',
                        render: function(data, type, row) {
                            return row.n_th_p || 0;
                        }
                    },
                    {
                        data: 'n_tf_p',
                        name: 'n_tf_p',
                        render: function(data, type, row) {
                            return row.n_tf_p || 0;
                        }
                    },
                    {
                        data: 'n_jk_p',
                        name: 'n_jk_p',
                        render: function(data, type, row) {
                            return row.n_jk_p || 0;
                        }
                    },
                    {
                        data: null,
                        name: null,
                        render: function(data, type, row) {

                            let disabel;
                            if (row.awal_surah_baru === null) {
                                disabel = 'true';
                            } else {
                                disabel = 'false';
                            }
                            
                                return `
                                <button class="btn btn-sm btn-danger ${disabel === 'true' ? 'disabled' : ''} hapusBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Penilaian Pengembangan Diri" 
                                data-id="${row.id_rapor}" data-peserta="${row.id_siswa}" 
                                data-tahun="${row.id_tahun_ajaran}" data-rapor="${row.jenis_periode}" 
                                data-periode="${row.id_periode}"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-primary ${disabel === 'true' ? 'disabled' : ''} lihatBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Peserta Rapor" 
                                data-id="${row.id_rapor}" data-peserta="${row.id_siswa}" 
                                data-tahun="${row.id_tahun_ajaran}" data-rapor="${row.jenis_periode}" 
                                data-periode="${row.id_periode}"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-warning ${disabel === 'true' ? 'disabled' : ''} downloadBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Rapor" 
                                data-id="${row.id_rapor}" data-peserta="${row.id_siswa}" 
                                data-tahun="${row.id_tahun_ajaran}" data-rapor="${row.jenis_periode}" 
                                data-periode="${row.id_periode}"><i class="fas fa-download"></i></button>
                                <button class="btn btn-sm btn-secondary ${disabel === 'true' ? 'disabled' : ''} editBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Penilaian Pengembangan Diri" 
                                data-id="${row.id_rapor}" data-peserta="${row.id_siswa}" 
                                data-tahun="${row.id_tahun_ajaran}" data-rapor="${row.jenis_periode}" 
                                data-periode="${row.id_periode}"><i class="fas fa-edit"></i></button>
                            `;
                        }
                    },
                ]
            });
        });

        // lihat data
        $(document).on('click', '.lihatBtn', function() {
            var id = $(this).data('id');
            var peserta = $(this).data('peserta');
            var tahun = $(this).data('tahun');
            var rapor = $(this).data('rapor');
            var periode = $(this).data('periode');
            var url= '{{ url('guru/penilaian_rapor/detail_peserta') }}/' + id + '/'+ peserta + '/'+ tahun + '/' + rapor + '/' + periode;
            window.location.href = url;
        });

        // Add Button
        $('#addBtn').on('click', function() {
            $('#ModalLabel').text('Tambah Penilaian Pengembangan Diri');
            $('#dataForm')[0].reset();
            $('.select2').val(null).trigger('change');
            $('#formModal').modal('show');
        });

        // save button
        $('#saveBtn').on('click', function() {
            var url = '{{ url('guru/penilaian_rapor/ajax_store_peserta') }}';
            var form = $('#dataForm')[0];
            var formData = new FormData(form);
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#dataForm')[0].reset();
                    $('#formModal').modal('hide');
                    $('#datatables-ajax').DataTable().ajax.reload();

                    Swal.fire({
                        title: response.success ? 'Success' : 'Error',
                        text: response.message,
                        icon: response.success ? 'success' : 'error',
                        confirmButtonText: 'OK'
                    });

                },
                error: function(response) {
                    $('#dataForm')[0].reset();
                    Swal.fire({
                        title: response.success ? 'Success' : 'Error',
                        text: response.message,
                        icon: response.success ? 'success' : 'error',
                        confirmButtonText: 'OK'
                    });

                }
            });
        });

        // delete 
        $(document).on('click', '.deleteBtn', function() {
            var id = $(this).data('id_penialain');
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
                        url: '{{ url('guru/penilaian_kegiatan/hapus_data_penilaian_kegiatan') }}/' +
                            id, // URL to delete data for the selected row
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (kegiatan === "tahfidz") {
                                $('#datatables-ajax-tahfidz').DataTable().ajax.reload();
                            } else {
                                $('#datatables-ajax-tahsin').DataTable().ajax.reload();
                            }
                            Swal.fire({
                                title: response.success ? 'Success' : 'Error',
                                text: response.message,
                                icon: response.success ? 'success' : 'error',
                                confirmButtonText: 'OK'
                            });
                            $('#datatables-ajax').DataTable().ajax.reload();
                        },
                        error: function(response) {
                            if (kegiatan === "tahfidz") {
                        $('#datatables-ajax-tahfidz').DataTable().ajax.reload();
                    } else {
                        $('#datatables-ajax-tahsin').DataTable().ajax.reload();
                    }
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


    </script>
@endsection
