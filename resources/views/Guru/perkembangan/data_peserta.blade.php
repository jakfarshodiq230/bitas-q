@extends('Guru.layout')
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
                    DATA PESERTA BINA PRIBADI ISLAM (BPI)
                </h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatables-ajax-peserta" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
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

        $(document).ready(function() {
            $('#datatables-ajax-peserta').DataTable({
                processing: true,
                serverSide: false,
                retrieve: false,
                destroy: true,
                responsive: true,
                ajax: '{{ url('guru/dashboard/perkembangan_peserta') }}',
                columns: [
                    {
                        "data": null,
                        "name": "rowNumber",
                        "render": function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'nama_siswa',
                        name: 'nama_siswa',
                        render: function(data, type, row) {
                            return row.nama_siswa.toUpperCase();
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return `
                                <button class="btn btn-sm btn-primary pesertaBtn me-1" data-id_peserta="${row.id_siswa}">
                                    <i class="fas fa-users"></i> LIHAT PERKEMBANGAN 
                                </button>
                            `;
                        }
                    }
                ]
            });
        });
        $(document).on('click', '.pesertaBtn', function() {
            var id_peserta = $(this).data('id_peserta');
            var url= '{{ url('guru/dashboard/detail_perkembangan_peserta') }}/' + id_peserta;
            window.location.href = url;
        });
    </script>
@endsection
