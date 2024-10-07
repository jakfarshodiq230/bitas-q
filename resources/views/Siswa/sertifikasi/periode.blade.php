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
                DATA SERTIFIKASI AL-QUR'AN
                </h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-body">
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
    </main>
@endsection
@section('scripts')
    <!-- Your other content -->
    <script>

        $(document).ready(function() {
            // menampilkan data
            $('#datatables-ajax').DataTable({
                processing: true,
                serverSide: false,
                retrieve: false,
                destroy: true,
                responsive: true,
                ajax: '{{ url('siswa/sertifikasi/ajax-data-periode') }}',
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
                            var jenis_periode = row.jenis_periode.toUpperCase();
                            var formatted_string = nama_tahun_ajaran + ' [ ' 
                            + jenis_periode +' '+ row.juz_periode + ' JUZ ] ';
                            return formatted_string;
                        }

                    },
                    {
                        data: 'status_periode',
                        name: 'status_periode',
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-sm btn-secondary lihatBtn me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Nilai Rapor" data-peserta="${row.id_peserta_sertifikasi}"><i class="fas fa-eye"></i></button>

                            `;
                        }
                    },
                ]
            });
        });

        // lihatData 
        $(document).on('click', '.lihatBtn', function() {
            var peserta = $(this).data('peserta');
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
                    var url = "{{ url('siswa/sertifikasi/detail-nilai') }}/" +peserta;
                    window.location.href = url;
                }
            });
        });

        $(document).on('click', '.downloadBtn', function() {
            var id_periode = $(this).data('id_periode');
            var jenjang = $(this).data('jenjang');
            var url= '{{ url('siswa/sertifikasi/downloadRapor') }}/'+ id_periode;
            window.location.href = url;
        });

    </script>
@endsection
