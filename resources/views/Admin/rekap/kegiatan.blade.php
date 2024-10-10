@extends('Admin.layout')
@section('content')
    <style>
        .border-navy {
            border: 2px solid navy;
            /* Adjust the border width as needed */
            border-radius: 5px;
            /* Optional: Adjust the border radius as needed */
        }
    </style>
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title">
                    REKAP KEGIATAN
                </h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card">
                                <div class="card-body border-navy">
                                    <form id="dataForm"
                                        enctype="multipart/form-data">
                                        @csrf
										<div class="row">
											<div class="mb-3 col-md-4">
												<label for="inputEmail4">Periode</label>
												<select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="periode" id="periode" data-bs-toggle="select2" required>
                                                        <option value="PILIH">PILIH</option>
                                                    </select>
                                                <input type="text" class="form-control" name="jenis_kegiatan" id="jenis_kegiatan" placeholder="jenis_kegiatan" hidden>
											</div>
											<div class="mb-3 col-md-3">
												<label for="inputEmail4">Kelas</label>
												<select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="kelas" id="kelas" data-bs-toggle="select2" required>
                                                        <option value="PILIH">PILIH</option>
                                                    </select>
											</div>
                                            <div class="mb-3 col-md-3">
												<label for="inputEmail3">Siswa</label>
												<select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="siswa" id="siswa" data-bs-toggle="select2" required>
                                                        <option value="PILIH">PILIH</option>
                                                    </select>
											</div>
                                            <div class="mb-3 col-md-2 mt-4 text-center">
                                                <button type="button" class="btn btn-primary downloadBtn" id="downloadBtn">Proses</button>
                                            </div>
										</div>

									</form>
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
        $('.select2').val(null).trigger('change');
        $('#dataForm')[0].reset();
        // tahun ajaran
        document.addEventListener('DOMContentLoaded', function() {
            const selectElements = [
                document.querySelector('select[name="periode"]'),
                document.querySelector('select[name="kelas"]'),
            ];
            const downloadBtn = document.querySelector('#downloadBtn');

            $.ajax({
                url: '{{ url('admin/rekap/kegiatan/periode_kegiatan') }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    
                    populateSelect('periode', response.periode, item => `${item.nama_tahun_ajaran} [ PENILAIAN ${item.jenis_periode.toUpperCase() + ' ' + item.jenis_kegiatan.toUpperCase()} ]`);
                    populateSelect('kelas', response.kelas, item => item.nama_kelas.toUpperCase());
                    $('.siswa').val(null).trigger('change');

                    // Tambahkan event listener untuk setiap perubahan pada periode dan kelas
                    $('#periode, #kelas').on('change', function() {
                        // Reset select siswa setiap ada perubahan pada periode atau kelas
                        $('.siswa').val(null).trigger('change');

                        let periodeSelected = $('#periode').val();
                        let kelasSelected = $('#kelas').val();
                        let jenisSelected = $('#jenis_kegiatan').val();

                        if (periodeSelected === 'PILIH' || kelasSelected === 'PILIH') {
                            Swal.fire({
                                title: 'Warning',
                                text: 'Please select both periode and kelas.',
                                icon: 'warning',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Loading',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            $.ajax({
                                url: '{{ url('admin/rekap/kegiatan/siswa_kegiatan') }}/' + periodeSelected + '/' + kelasSelected + '/' + jenisSelected,
                                type: 'GET',
                                dataType: 'json',
                                success: function(response) {
                                    if (response.siswa) {
                                        populateSelect('siswa', response.siswa, item => item.nama_siswa.toUpperCase());
                                        Swal.close();
                                    } else {
                                        $('.siswa').val(null).trigger('change');
                                        Swal.fire({
                                            title: 'Error',
                                            text: 'No students found.',
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                },
                                error: function() {
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Failed to load data siswa.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            });
                        }
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to load data periode and kelas.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });

            function populateSelect(name, data, formatText) {
                const selectElement = document.querySelector(`select[name="${name}"]`);
                // Kosongkan select sebelum diisi ulang
                $(selectElement).empty();
                
                // Tambahkan pilihan default
                const defaultOption = document.createElement('option');
                defaultOption.value = 'PILIH';
                defaultOption.textContent = 'PILIH';
                selectElement.appendChild(defaultOption);

                // Populate the select element
                data.forEach(item => {
                    const option = document.createElement('option');

                    option.value = (name === 'periode') ? item.id_periode : 
                                (name === 'kelas') ? item.id_kelas : item.id_siswa;


                    option.textContent = formatText(item);
                    selectElement.appendChild(option);
                });

                $(selectElement).select2();

                if (name === 'periode') {
                    $(selectElement).on('change', function() {
                        const selectedPeriodeId = this.value;
                        const selectedItem = data.find(item => item.id_periode === selectedPeriodeId);
                        if (selectedItem) {
                            document.querySelector('#jenis_kegiatan').value = selectedItem.judul_periode;
                        } else {
                            // If no match is found, clear the input
                            document.querySelector('#jenis_kegiatan').value = '';
                        }
                    });
                }

                // Tambahkan logika untuk mengaktifkan/menonaktifkan tombol download atau save berdasarkan input
                function checkInputs() {
                    const selectPeriode = document.querySelector('select[name="periode"]');
                    const selectKelas = document.querySelector('select[name="kelas"]');
                    if (
                        selectPeriode.value.trim() === 'PILIH' || 
                        selectKelas.value.trim() === 'PILIH' || 
                        selectPeriode.value.trim() === '' || 
                        selectKelas.value.trim() === ''
                    ) {
                        downloadBtn.disabled = true;
                    } else {
                        downloadBtn.disabled = false;
                    }
                }

                $(selectElement).on('change', checkInputs);
                checkInputs();
            }
        });


        // save dan update data
        $('#downloadBtn').on('click', function() {
            var idPeriode = $('#periode').val();
            var idKelas = $('#kelas').val();
            var idSiswa = $('#siswa').val();
            var url = '{{ url('admin/rekap/kegiatan/download') }}/' + idPeriode + '/' + idKelas + '/' + idSiswa;
            Swal.fire({
                title: 'Mendownload...',
                text: 'Sedang mendownload data, harap tunggu.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                url: url,
                type: 'GET',
                xhrFields: {
                    responseType: 'blob' // important for file downloads
                },
                success: function(data, status, xhr) {
                    // Extract filename from content-disposition header
                    var disposition = xhr.getResponseHeader('Content-Disposition');
                    var filename = disposition ? disposition.split('filename=')[1] : 'default.xlsx';
                    
                    // Create a link element
                    var link = document.createElement('a');
                    var url = window.URL.createObjectURL(data);
                    link.href = url;
                    link.download = filename; // Use the filename from header
                    
                    document.body.appendChild(link);
                    link.click();
                    
                    // Cleanup
                    window.URL.revokeObjectURL(url);
                    document.body.removeChild(link);
                    Swal.close();
                },
                error: function(xhr, status, error) {
                    console.error('Download failed:', error);
                }
            });
        });

    </script>
@endsection
