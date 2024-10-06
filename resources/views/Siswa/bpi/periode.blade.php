@extends('Siswa.layout')
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
                DATA BINA PRIBADI ISLAM (BPI)
                </h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="tab">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab" role="tab">MANDIRI</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-2" data-bs-toggle="tab" role="tab">RAPOR</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab-1" role="tabpanel">
                                        <table id="datatables-mandiri" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>TAHUN</th>
                                                    <th>SHOLAT WAJIB</th>
                                                    <th>TILAWAH</th>
                                                    <th>TAHAJJUD</th>
                                                    <th>DUHA</th>
                                                    <th>RAWATIB</th>
                                                    <th>DZIKIR</th>
                                                    <th>PUASA</th>
                                                    <th>INFAQ</th>
                                                    <th>KETERANGAN</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>TAHUN</th>
                                                    <th>SHOLAT WAJIB</th>
                                                    <th>TILAWAH</th>
                                                    <th>TAHAJJUD</th>
                                                    <th>DUHA</th>
                                                    <th>RAWATIB</th>
                                                    <th>DZIKIR</th>
                                                    <th>PUASA</th>
                                                    <th>INFAQ</th>
                                                    <th>KETERANGAN</th>
                                                </tr>
                                            </tfoot>
                                        </table>
									</div>
									<div class="tab-pane" id="tab-2" role="tabpanel">
                                        <table id="datatables-ajax" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>RAPOR</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>RAPOR</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </tfoot>
                                        </table>
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
        $('.select2').val(null).trigger('change');
        $(document).ready(function() {
            // menampilkan data 
            $('#datatables-mandiri').DataTable({
                processing: true,
                serverSide: false,
                retrieve: false,
                destroy: true,
                responsive: true,
                ajax: '{{ url('siswa/bpi/ajax-nilai-mandiri') }}',
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
                            var formatted_string = row.nama_tahun_ajaran.toUpperCase() + '<br>' + row.jenis_kegiatan.toUpperCase();
                            return formatted_string;
                        }
                    },
                    {
                        data: 'sholat_wajib',
                        name: 'sholat_wajib',
                    },
                    {
                        data: 'tilawah',
                        name: 'tilawah',
                    },
                    {
                        data: 'tahajud',
                        name: 'tahajud',
                    },
                    {
                        data: 'duha',
                        name: 'duha',
                    },
                    {
                        data: 'rawatib',
                        name: 'rawatib',
                    },
                    {
                        data: 'dzikri',
                        name: 'dzikri',
                    },
                    {
                        data: 'puasa',
                        name: 'puasa',
                    },
                    {
                        data: 'infaq',
                        name: 'infaq',
                    },
                    {
                        data: 'status_amal',
                        name: 'status_amal',
                        render: function(data, type, row) {
                            return `
                                <span class="status badge ${row.status_amal === 0 ? 'bg-warning' : (row.status_amal === 1 ? 'bg-success' : 'bg-danger')}" 
                                    style="display: inline-block;">
                                    ${row.status_amal === 0 ? 'Proses Verifikasi' : (row.status_amal === 1 ? 'Data Sesuai' : 'Tidak Sesuai')}
                                </span>
                                <span>${row.ktr_amal}</span>

                            `;
                        }
                    },
                ]
            });

            $('#datatables-ajax').DataTable({
                processing: true,
                serverSide: false,
                retrieve: false,
                destroy: true,
                responsive: true,
                ajax: '{{ url('siswa/bpi/ajax-data-periode') }}',
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
                            var nama_tahun_ajaran = row.nama_tahun_ajaran.toUpperCase();
                            var jenis_periode = 'BINA PRIBADI ISLAM (BPI)';
                            var formatted_string = nama_tahun_ajaran + ' [ ' 
                            + jenis_periode + ' ' + row.jenis_kegiatan.toUpperCase()+' ] ';
                            return formatted_string;
                        }

                    },
                    {
                        data: 'status_periode',
                        name: 'status_periode',
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-sm btn-secondary lihatBtn me-1" 
                                data-bs-toggle="tooltip" data-bs-placement="top" 
                                title="Lihat Nilai Rapor" 
                                data-id_periode="${row.id_periode}"
                                ${new Date(row.tggl_akhir_penilaian) > new Date() ? 'disabled' : ''}>
                                <i class="fas fa-eye"></i></button>

                                <button class="btn btn-sm btn-warning downloadBtn me-1" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Penilaian Peserta" 
                                        data-id_periode="${row.id_periode}" 
                                        ${new Date(row.tggl_akhir_penilaian) > new Date() ? 'disabled' : ''}>
                                        <i class="fas fa-download"></i>
                                </button>
                                
                                <button class="btn btn-sm btn-info mandiriBtn me-1" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Amalan Mandiri" 
                                        data-id_periode="${row.id_periode}">
                                        <i class="fas fa-edit"></i>
                                </button>

                                <span class="status badge bg-success" 
                                    style="display: ${new Date(row.tggl_akhir_penilaian) > new Date() ? 'inline-block' : 'none'};">
                                    ${new Date(row.tggl_akhir_penilaian) > new Date() ? 'Dalam Proses Penilaian' : ''}
                                </span>
                            `;
                        }
                    },
                ]
            });
        });

        // lihatData 
        $(document).on('click', '.lihatBtn', function() {
            var id_periode = $(this).data('id_periode');
            Swal.fire({
                title: 'Penilaian',
                text: 'Apakah Anda Ingin Melihat Penilaian?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, saya akan melihat data penilaian'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ url('siswa/bpi/detail-nilai') }}/" +id_periode;
                    window.location.href = url;
                }
            });
        });

        $(document).on('click', '.downloadBtn', function() {
            var id_periode = $(this).data('id_periode');
            var jenjang = $(this).data('jenjang');
            var url= '{{ url('siswa/bpi/downloadRapor') }}/'+ id_periode;
            window.location.href = url;
        });
    </script>
@endsection
