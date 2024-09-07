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
                    DATA PERIODE RAPOR AL-QUR'AN
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
												<label for="inputEmail4">Tahun Ajaran</label>
												<select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                        name="tahun_ajaran" data-bs-toggle="select2" required>
                                                        <option>PILIH</option>
                                                    </select>
                                                    <input type="text" name="id_periode" id="id_periode" hidden>
											</div>
											<div class="mb-3 col-md-4">
												<label for="inputPassword4">Rapor</label>
                                                <select class="form-control select2 mb-4 me-sm-2 mt-0 " name="kegiatan"
                                                data-bs-toggle="select2" required>
                                                <option selected>PILIH</option>
                                                <option value="tahfidz">TAHFIDZ</option>
                                                <option value="tahsin">TAHSIN</option>
                                            </select>
											</div>
                                            <div class="mb-3 col-md-4">
												<label for="inputPassword4">Jenis Rapor</label>
                                                <select class="form-control select2 mb-4 me-sm-2 mt-0 " name="jenis_kegiatan"
                                                data-bs-toggle="select2" required>
                                                <option selected>PILIH</option>
                                                <option value="ganjil">GANJIL</option>
                                                <option value="genap">GENAP</option>
                                            </select>
											</div>
										</div>
                                        <div class="row">
											<div class="mb-3 col-md-4">
												<label for="inputEmail4">Taggal Mulai Rapor</label>
												<input type="date" class="form-control" name="tggl_awal_periode" id="tggl_awal_periode" placeholder="Email">
											</div>
											<div class="mb-3 col-md-4">
												<label for="inputEmail4">Taggal Akhir Rapor</label>
												<input type="date" class="form-control" name="tggl_akhir_periode" id="tggl_akhir_periode" placeholder="Password">
											</div>
                                            <div class="mb-3 col-md-4">
												<label for="inputEmail4">Taggal Akhir Penilaian Rapor</label>
												<input type="datetime-local" class="form-control" name="tggl_akhir_penilaian" id="tggl_akhir_penilaian" placeholder="Password">
											</div>
                                            <div class="mb-3 col-md-4">
												<label for="inputEmail4">Taggal Rapor</label>
												<input type="date" class="form-control" name="tggl_periode" id="tggl_periode" placeholder="Password">
											</div>
                                            <div class="mb-3 col-md-4">
												<label for="inputEmail4">Penanggung Jawab Rapor</label>
												<input type="text" class="form-control" name="tanggungjawab_periode" id="tanggungjawab_periode" placeholder="Penanggung Jawab Rapor">
											</div>
                                            <div class="mb-3 col-md-4">
												<label for="inputEmail4">Pesan Rapor</label>
												<textarea class="form-control" name="pesan_periode" id="pesan_periode" rows="1" cols="10" placeholder="Pesan Rapor Untuk Peserta" maxlength="100"></textarea>
											</div>
										</div>
										<div class="text-end">
                                            <button type="button" class="btn btn-primary saveBtn" id="saveBtn">Simpan</button>
                                        </div>
									</form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatables-ajax" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Periode</th>
                                        <th>Tanggal</th>
                                        <th>Pesan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Periode</th>
                                        <th>Tanggal</th>
                                        <th>Pesan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
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
                document.querySelector('select[name="tahun_ajaran"]'),
                document.querySelector('select[name="kegiatan"]'),
                document.querySelector('select[name="jenis_kegiatan"]')
            ];

            const inputElements = [
                document.querySelector('input[name="tggl_awal_periode"]'),
                document.querySelector('input[name="tggl_akhir_periode"]'),
                document.querySelector('input[name="tggl_akhir_penilaian"]'),
                document.querySelector('input[name="tanggungjawab_periode"]')
            ];

            const textareaElement = document.querySelector('textarea[name="pesan_periode"]');
            const saveBtn = document.querySelector('#saveBtn'); // Adjust the selector as needed

            $.ajax({
                url: '{{ url('admin/periode/data_tahun') }}',
                type: 'GET',
                dataType: 'json', // Ensure response is treated as JSON
                success: function(response) {
                    const data = response.data; // Assuming response has a 'data' array
                    const tahun_list = document.querySelector('select[name="tahun_ajaran"]');
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id_tahun_ajaran;
                        option.textContent = item.nama_tahun_ajaran;
                        tahun_list.appendChild(option);
                    });

                    // Initialize Select2 after appending options
                    $(tahun_list).select2();
                },
                error: function(xhr, status, error) {
                    // Handle error
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to load data tahun',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });

            function checkInputs() {
                const allInputsFilled = [
                    ...selectElements,
                    ...inputElements,
                    textareaElement
                ].every(el => el.value.trim() !== '' && el.value.trim() !== 'PILIH');

                saveBtn.disabled = !allInputsFilled;
            }

            [...selectElements, ...inputElements, textareaElement].forEach(element => {
                element.addEventListener('input', checkInputs);
            });

            checkInputs(); // Initial check
        });


        $(document).ready(function() {
            // menampilkan data
            $('#datatables-ajax').DataTable({
                processing: true,
                serverSide: false,
                retrieve: false,
                destroy: true,
                responsive: true,
                ajax: '{{ url('admin/periode_rapor/data_periode_rapor') }}',
                columns: [{
                        "data": null,
                        "name": "rowNumber",
                        "render": function(data, type, row, meta) {
                            return meta.row +
                                1;
                        }
                    },
                    {
                        data: 'nama_tahun_ajaran',
                        name: 'nama_tahun_ajaran',
                        render: function(data, type, row) {
                            var nama_tahun_ajaran = row.nama_tahun_ajaran.charAt(0).toUpperCase() +
                                row.nama_tahun_ajaran.slice(1);
                            var jenis_periode = row.jenis_periode.trim().toUpperCase();
                            var jenis_kegiatan = row.jenis_kegiatan.trim().toUpperCase();
                            var tanggal = new Date(row.tggl_periode);
                            var options = { day: 'numeric', month: 'long', year: 'numeric' };
                            var tanggal_formatted = tanggal.toLocaleDateString('id-ID', options);
                            return 'Periode : ' + nama_tahun_ajaran + '<br>' +
                            'Rapor : ' +  jenis_periode +' '+ jenis_kegiatan +
                            '<br> Penanggung Jawab : ' + row.tanggungjawab_periode +
                            '<br> Tanggal Rapor : ' + tanggal_formatted;
                        }

                    },
                    {
                        data: null,
                        name: null,
                        render: function(data, type, row) {
                            var tanggal_mulai = new Date(row.tggl_awal_periode);
                            var tanggal_akhir = new Date(row.tggl_akhir_periode);
                            var tanggal = new Date(row.tggl_akhir_penilaian);
                            var tanggal_syn = new Date(row.updated_at);
                            var options = { day: 'numeric', month: 'long', year: 'numeric' };
                            var tanggal_mulai_1 = tanggal_mulai.toLocaleDateString('id-ID', options);
                            var tanggal_akhir_2 = tanggal_akhir.toLocaleDateString('id-ID', options);
                            
                            const options2 = { 
                                day: 'numeric', 
                                month: 'long', 
                                year: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric',
                                second: 'numeric',
                                hour12: false // Use 24-hour format; set to true for 12-hour format
                            };
                            var tanggal_formatted = tanggal.toLocaleDateString('id-ID', options2);
                            var tanggal_sinkron= tanggal_syn.toLocaleDateString('id-ID', options2);
                            return `Mulai Rapor : ${tanggal_mulai_1} s/d  ${tanggal_akhir_2} <br>
                            <span class="badge ${new Date(row.tggl_akhir_penilaian) < new Date() ? 'bg-danger' : 'bg-success'}">Akhir Penilaian : ${tanggal_formatted}
                            </span> <br>
                            <span class="badge bg-success">Sinkronisasi Data : ${tanggal_sinkron}</span>`;
                        }

                    },
                    {
                        data: 'pesan_periode',
                        name: 'pesan_periode',
                    },
                    {
                        data: 'status_periode',
                        name: 'status_periode',
                        render: function(data, type, row) {
                            if (data == 1) {
                                return '<span class="badge bg-success">Aktif</span>';
                            } else if (data == 0) {
                                return '<span class="badge bg-danger">Tidak Aktif</span>';
                            } else {
                                return '<span class="badge bg-warning">Hapus</span>';
                            }
                        }

                    },
                    {
                        data: 'status_periode',
                        name: 'status_periode',
                        render: function(data, type, row) {
                            if (data == 1) {
                                return `
                                <button class="btn btn-sm btn-danger updateBtn0 me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Status Tidak Aktif" data-id="${row.id_periode}"><i class="fas fa-power-off"></i></button>
                                <button class="btn btn-sm btn-warning editBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data" data-id="${row.id_periode}"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-secondary deleteBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" data-id="${row.id_periode}"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-primary pesertaBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Generate Data Rapor" data-tahun="${row.id_tahun_ajaran}" data-rapor="${row.jenis_periode}" data-periode="${row.id_periode}"><i class="fas fa-users"></i></button>
                            `;
                            } else {
                                return `
                                <button class="btn btn-sm btn-success updateBtn1 me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Status Aktif" data-id="${row.id_periode}"><i class="fas fa-power-off"></i></button>
                                <button class="btn btn-sm btn-warning editBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data" data-id="${row.id_periode}"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-secondary deleteBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" data-id="${row.id_periode}"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-primary pesertaBtn me-1 disabled" data-bs-toggle="tooltip" data-bs-placement="top" title="Generate Data Rapor" data-tahun="${row.id_tahun_ajaran}" data-rapor="${row.jenis_periode}" data-periode="${row.id_periode}"><i class="fas fa-users"></i></button>
                            `;
                            }
                        }
                    },
                ]
            });
        });

        // editData
        $(document).on('click', '.editBtn', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Edit Data',
                text: 'Apakah Anda Ingin Mengedit Data Ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, saya mengedit data ini'
            }).then((result) => {
                $.ajax({
                    url: '{{ url('admin/periode/edit_periode') }}/' +
                        id, // URL to fetch data for the selected row
                    type: 'GET',
                    success: function(data) {
                        saveBtn.disabled  = false;
                        // Populate the modal fields with the data
                        $('#dataForm input[name="id_periode"]').val(data.data.id_periode);
                        $('select[name="tahun_ajaran"] option').each(function() {
                            if ($(this).val() === data.data.id_tahun_ajaran) {
                                $(this).prop('selected', true);
                            }
                        });

                        $('select[name="tahun_ajaran"]').select2();
                        $('select[name="kegiatan"] option').each(function() {
                            if ($(this).val() === data.data.jenis_periode) {
                                $(this).prop('selected', true);
                            }
                        });
                        $('select[name="kegiatan"]').select2();

                        $('select[name="jenis_kegiatan"]').select2();
                        $('select[name="jenis_kegiatan"] option').each(function() {
                            if ($(this).val() === data.data.jenis_kegiatan) {
                                $(this).prop('selected', true);
                            }
                        });
                        $('select[name="jenis_kegiatan"]').select2();

                        $('#dataForm input[name="tggl_awal_periode"]').val(data.data.tggl_awal_periode);
                        $('#dataForm input[name="tggl_akhir_periode"]').val(data.data.tggl_akhir_periode);
                        $('#dataForm input[name="tggl_akhir_penilaian"]').val(data.data.tggl_akhir_penilaian);
                        $('#dataForm input[name="tggl_periode"]').val(data.data.tggl_periode);
                        $('#dataForm input[name="tanggungjawab_periode"]').val(data.data.tanggungjawab_periode);
                        $('#dataForm textarea[name="pesan_periode"]').val(data.data.pesan_periode);
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
            });
        });

        // save dan update data
        $('#saveBtn').on('click', function() {
            var id = $('#id_periode').val();
            var url = '{{ url('admin/periode_rapor/store_periode_rapor') }}';

            if (id) {
                url = '{{ url('admin/periode_rapor/update_periode_rapor') }}/' + id;
            }
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
                    $('.select2').val(null).trigger('change');
                    $('#datatables-ajax').DataTable().ajax.reload();
                    Swal.fire({
                        title: response.success ? 'Success' : 'Error',
                        text: response.message,
                        icon: response.success ? 'success' : 'error',
                        confirmButtonText: 'OK'
                    });
                    
                },
                error: function(response) {
                    $('.select2').val(null).trigger('change');
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
            var id = $(this).data('id');
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
                $.ajax({
                    url: '{{ url('admin/periode_rapor/delete_periode_rapor') }}/' +
                        id, // URL to delete data for the selected row
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Reload the table data
                        $('.select2').val(null).trigger('change');
                        Swal.fire({
                            title: response.success ? 'Success' : 'Error',
                            text: response.message,
                            icon: response.success ? 'success' : 'error',
                            confirmButtonText: 'OK'
                        });
                        $('#datatables-ajax').DataTable().ajax.reload();
                    },
                    error: function(response) {
                        $('.select2').val(null).trigger('change');
                        Swal.fire({
                            title: response.success ? 'Success' : 'Error',
                            text: response.message,
                            icon: response.success ? 'success' : 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });

        // update status 
        $(document).on('click', '.updateBtn1, .updateBtn0', function() {
            var id = $(this).data('id');
            console.log(id);
            var status = $(this).hasClass('updateBtn1') ? 1 : 0; // Determine status based on the class

            Swal.fire({
                title: 'Aktifkan Data',
                text: 'Apakah Anda Ingin Mengaktifkan Data Ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, saya menghapus data ini'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url('admin/periode_rapor/status_periode_rapor') }}/' + id + '/' + status,
                        type: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('.select2').val(null).trigger('change');
                            Swal.fire({
                                title: response.error ? 'Error!' : 'Success!',
                                text: response.message,
                                icon: response.error ? 'error' : 'success',
                                confirmButtonText: 'OK'
                            });
                            $('#datatables-ajax').DataTable().ajax.reload();
                        },
                        error: function(response) {
                            $('.select2').val(null).trigger('change');
                            Swal.fire({
                                title: 'Gagal!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        });

        //peserta
        $(document).on('click', '.pesertaBtn', function() {
            var tahun = $(this).data('tahun');
            var rapor = $(this).data('rapor');
            var periode = $(this).data('periode');
            Swal.fire({
                title: 'Peserta',
                text: 'Apakah Anda Ingin Generate Peserta?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, saya generate data peserta'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Generate Peserta...',
                        text: 'Sedang generate data peserta, harap tunggu.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    $.ajax({
                        url: '{{ url('admin/periode_rapor/peserta_periode_rapor') }}/' + tahun + '/' + rapor + '/' + periode,
                        type: 'GET',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('.select2').val(null).trigger('change');
                            Swal.fire({
                                title: response.error ? 'Error!' : 'Success!',
                                text: response.message,
                                icon: response.error ? 'error' : 'success',
                                confirmButtonText: 'OK'
                            });
                            $('#datatables-ajax').DataTable().ajax.reload();
                        },
                        error: function(response) {
                            $('.select2').val(null).trigger('change');
                            Swal.fire({
                                title: 'Gagal!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
