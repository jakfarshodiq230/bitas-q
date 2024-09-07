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
                    DETAIL PENILAIAN PESERTA BINA PRIBADI ISLAM (BPI)
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
                                        <span class="label text-end" style="flex: 1;">Kegiatan</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="kegiatan" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Pembimbing</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="pembimbing" style="flex: 1;">-</span>
                                    </div>
                                </div>
                                <div class="col-md-4 profile">
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Nama</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="nama" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Kelas</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="kelas" style="flex: 1;">-</span>
                                    </div>
                                    <div class="profile-item mb-3 d-flex justify-content-between">
                                        <span class="label text-end" style="flex: 1;">Kali/Pekan</span>
                                        <span class="separator">:</span>
                                        <span class="value text-start" id="kali_pekan" style="flex: 1;">-</span>
                                    </div>
                                </div>
                                <div class="col-md-4 profile">
                                    <div class="text-center">
                                        <img alt="Peserta" id="avatarImg" src=""
                                            class="rounded-circle img-responsive" width="100" height="100" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- grafik penilaian -->
                    <div class="card ">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="card ">
                                        <div class="card-header">
                                            <h5 class="card-title text-center">BIDANG STUDI</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="parent-container">
                                                <canvas id="chartjs-bidang_studi"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title text-center">KARAKTER</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="parent-container">
                                                <canvas id="chartjs-karakter"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title text-center">AKTIVITAS AMAL</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="parent-container">
                                                <canvas id="chartjs-amal"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- bidang studi --}}
                    <div class="card" id="bidang_studi">
                        <div class="card-body">
                            <table id="datatables-ajax-bidang_studi" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>KALI/PEKAN</th>
                                        <th>AL-QUR'AN</th>
                                        <th>AQIDAH</th>
                                        <th>TAZ</th>
                                        <th>IBADAH</th>
                                        <th>HADITS</th>
                                        <th>SIRAH</th>
                                        <th>FIKRUL ISLAM</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>KALI/PEKAN</th>
                                        <th>AL-QUR'AN</th>
                                        <th>AQIDAH</th>
                                        <th>TAZ</th>
                                        <th>IBADAH</th>
                                        <th>HADITS</th>
                                        <th>SIRAH</th>
                                        <th>FIKRUL ISLAM</th>
                                        <th>ACTION</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    {{-- Karakter --}}
                    <div class="card" id="karakter">
                        <div class="card-body">
                            <table id="datatables-ajax-karakter" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>KALI/PEKAN</th>
                                        <th>AQDH</th>
                                        <th>IBDH</th>
                                        <th>AKHLK</th>
                                        <th>PRBD</th>
                                        <th>AQR</th>
                                        <th>WWSN</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>KALI/PEKAN</th>
                                        <th>AQDH</th>
                                        <th>IBDH</th>
                                        <th>AKHLK</th>
                                        <th>PRBD</th>
                                        <th>AQR</th>
                                        <th>WWSN</th>
                                        <th>ACTION</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    {{-- Aktivitas Amal --}}
                    <div class="card" id="aktivitas_amal">
                        <div class="card-body">
                            <table id="datatables-ajax-aktivitas_amal" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>KALI/PEKAN</th>
                                        <th>SHOLAT WAJIB</th>
                                        <th>TILAWAH</th>
                                        <th>TAHAJJUD</th>
                                        <th>DUHA</th>
                                        <th>RAWATIB</th>
                                        <th>DZIKIR</th>
                                        <th>PUASA</th>
                                        <th>INFAQ</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>KALI/PEKAN</th>
                                        <th>SHOLAT WAJIB</th>
                                        <th>TILAWAH</th>
                                        <th>TAHAJJUD</th>
                                        <th>DUHA</th>
                                        <th>RAWATIB</th>
                                        <th>DZIKIR</th>
                                        <th>PUASA</th>
                                        <th>INFAQ</th>
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
        var id_siswa = "{{ $siswa }}";
        var id_kelas = "{{ $kelas }}";
        var periode = "{{ $periode }}";
        var tahun = "{{ $tahun }}";
        var guru = "{{ $guru }}";
        var tahun_nama = '';

        const tables = ['aktivitas_amal', 'karakter', 'bidang_studi'];

        const ranges = {
            "sangat_baik": {
                min: 96,
                max: 100
            },
            "baik": {
                min: 86,
                max: 95
            },
            "cukup": {
                min: 80,
                max: 85
            },
            "kurang": {
                min: 0,
                max: 79
            }
        };

        function handleNilaiChange(selectElement, select) {
            const id = selectElement.value;
            select.empty();
            select.append('<option>PILIH</option>'); // Add default option

            if (ranges[id]) {
                const {
                    min,
                    max
                } = ranges[id];
                for (let i = min; i <= max; i++) {
                    select.append('<option value="' + i + '">' + i + '</option>');
                }
            }

            // Display alert if "PILIH" is selected
            if (id === "PILIH") {
                alert("Silahkan Pilih");
            }
        }

        function getRange(input) {
            for (const [key, value] of Object.entries(ranges)) {
                if (input >= value.min && input <= value.max) {
                    return key;
                }
            }
        }
        // tabel
        $(document).ready(function() {
            // profil
            $.ajax({
                url: "{{ url('admin/penilaian_pbi/data_penilaian_pbi_all') }}/" + tahun +
                        '/' + periode +
                        '/' + id_siswa +
                        '/' + guru +
                        '/' + id_kelas ,
                type: 'GET',
                success: function(data) {
                    tahun_nama = data.peserta.nama_tahun_ajaran;
                    $('#kegiatan').text('BINA PRIBADI ISLAM (BPI)');
                    $('#tahun_ajaran').text(capitalizeFirstLetter(data.peserta.nama_tahun_ajaran.toUpperCase()));
                    $('#pembimbing').text(capitalizeFirstLetter(data.peserta.nama_guru.toUpperCase()));
                    $('#nama').text(capitalizeFirstLetter(data.peserta.nama_siswa.toUpperCase()));
                    $('#kelas').text(data.peserta.nama_kelas.toUpperCase());
                    $('#kali_pekan').text(data.peserta.sesi_periode);
                    if (data.peserta.foto_siswa != null) {
                        var fotoSiswaUrl = "{{ url('storage') }}/" + data.peserta.foto_siswa;
                        $('#avatarImg').attr('src', fotoSiswaUrl);
                    } else {
                        var fotoSiswaUrl = '{{ asset('assets/admin/img/avatars/avatar.jpg') }}'
                        $('#avatarImg').attr('src', fotoSiswaUrl);
                    }

                    function capitalizeFirstLetter(string) {
                        return string.charAt(0).toUpperCase() + string.slice(1);
                    }
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
            // tabel
            $('#datatables-ajax-bidang_studi').DataTable({
                processing: true,
                serverSide: false,
                retrieve: false,
                destroy: true,
                responsive: true,
                ajax: {
                    url: "{{ url('admin/penilaian_pbi/data_penilaian_pbi_all') }}/" + tahun +
                        '/' + periode +
                        '/' + id_siswa +
                        '/' + guru +
                        '/' + id_kelas ,
                    dataSrc: "nilai_bidang_studi",
                    error: function(xhr, error, thrown) {
                        console.log("AJAX error:", error);
                        console.log("Thrown error:", thrown);
                    }
                },

                columns: [{
                        "data": null,
                        "name": "rowNumber",
                        "render": function(data, type, row, meta) {
                            return 'KALI/PEKAN ' + row.pekan_bidang_studi;
                        }
                    },
                    {
                        data: 'alquran',
                        name: 'alquran'
                    },
                    {
                        data: 'aqidah',
                        name: 'aqidah'
                    },
                    {
                        data: 'ibadah',
                        name: 'ibadah'
                    },
                    {
                        data: 'hadits',
                        name: 'hadits'
                    },
                    {
                        data: 'sirah',
                        name: 'sirah'
                    },
                    {
                        data: 'tazkiyatun',
                        name: 'tazkiyatun'
                    },
                    {
                        data: 'fikrul',
                        name: 'fikrul'
                    },
                    {
                        data: 'status_bidang_studi',
                        name: 'status_bidang_studi',
                        render: function(data, type, row) {
                            return row.status_bidang_studi === 1 
                                ? '<span class="badge bg-success me-1">DIPADANKAN</span>' 
                                : '<span class="badge bg-danger me-1">BELUM DIPADANKAN</span>';
                        }
                    }
                ]
            });

            $('#datatables-ajax-karakter').DataTable({
                processing: true,
                serverSide: false,
                retrieve: false,
                destroy: true,
                responsive: true,
                ajax: {
                    url: "{{ url('admin/penilaian_pbi/data_penilaian_pbi_all') }}/" + tahun +
                        '/' + periode +
                        '/' + id_siswa +
                        '/' + guru +
                        '/' + id_kelas ,
                    dataSrc: "nilai_karakter",
                    error: function(xhr, error, thrown) {
                        console.log("AJAX error:", error);
                        console.log("Thrown error:", thrown);
                    }
                },

                columns: [{
                        "data": null,
                        "name": "rowNumber",
                        "render": function(data, type, row, meta) {
                            return 'KALI/PEKAN ' + row.pekan_karakter;
                        }
                    },
                    {
                        data: 'aqdh',
                        name: 'aqdh'
                    },
                    {
                        data: 'ibdh',
                        name: 'ibdh'
                    },
                    {
                        data: 'akhlak',
                        name: 'akhlak'
                    },
                    {
                        data: 'prbd',
                        name: 'prbd'
                    },
                    {
                        data: 'aqr',
                        name: 'aqr'
                    },
                    {
                        data: 'wwsn',
                        name: 'wwsn'
                    },
                    {
                        data: 'status_karakter',
                        name: 'status_karakter',
                        render: function(data, type, row) {
                            return row.status_karakter === 1 
                                ? '<span class="badge bg-success me-1">DIPADANKAN</span>' 
                                : '<span class="badge bg-danger me-1">BELUM DIPADANKAN</span>';
                        }
                    }
                ]
            });

            $('#datatables-ajax-aktivitas_amal').DataTable({
                processing: true,
                serverSide: false,
                retrieve: false,
                destroy: true,
                responsive: true,
                ajax: {
                    url: "{{ url('admin/penilaian_pbi/data_penilaian_pbi_all') }}/" + tahun +
                        '/' + periode +
                        '/' + id_siswa +
                        '/' + guru +
                        '/' + id_kelas ,
                    dataSrc: "nilai_amal",
                    error: function(xhr, error, thrown) {
                        console.log("AJAX error:", error);
                        console.log("Thrown error:", thrown);
                    }
                },

                columns: [{
                        "data": null,
                        "name": "rowNumber",
                        "render": function(data, type, row, meta) {
                            return 'KALI/PEKAN ' + row.pekan_amal;
                        }
                    },
                    {
                        data: 'sholat_wajib',
                        name: 'sholat_wajib',
                        render: function(data, type, row) {
                            return row.sholat_wajib + ' KALI';
                        }
                    },
                    {
                        data: 'tilawah',
                        name: 'tilawah',
                        render: function(data, type, row) {
                            return row.tilawah + ' KALI';
                        }
                    },
                    {
                        data: 'tahajud',
                        name: 'tahajud',
                        render: function(data, type, row) {
                            return row.tilawah + ' KALI';
                        }
                    },
                    {
                        data: 'duha',
                        name: 'duha',
                        render: function(data, type, row) {
                            return row.duha + ' KALI';
                        }
                    },
                    {
                        data: 'rawatib',
                        name: 'rawatib',
                        render: function(data, type, row) {
                            return row.rawatib + ' KALI';
                        }
                    },
                    {
                        data: 'dzikri',
                        name: 'dzikri',
                        render: function(data, type, row) {
                            return row.dzikri + ' KALI';
                        }
                    },
                    {
                        data: 'puasa',
                        name: 'puasa',
                        render: function(data, type, row) {
                            return row.puasa + ' KALI';
                        }
                    },
                    {
                        data: 'infaq',
                        name: 'infaq',
                        render: function(data, type, row) {
                            return row.infaq + ' KALI';
                        }
                    },
                    {
                        data: 'status_amal',
                        name: 'status_amal',
                        render: function(data, type, row) {
                            return row.status_amal === 1 
                                ? '<span class="badge bg-success me-1">DIPADANKAN</span>' 
                                : '<span class="badge bg-danger me-1">BELUM DIPADANKAN</span>';
                        }
                    }
                ]
            });
        });

        // grafik
        document.addEventListener("DOMContentLoaded", function() {
            // Fungsi untuk menampilkan persentase di tengah chart
            function drawCenterText(chart) {
                var width = chart.chart.width,
                    height = chart.chart.height,
                    ctx = chart.chart.ctx;
                ctx.restore();
                var fontSize = (height / 100).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = "middle";

                // Hitung persentase dari dataset pertama
                var total = chart.config.data.datasets[0].data.reduce((a, b) => a + b, 0);
                var value = chart.config.data.datasets[0].data[0];
                var percentage = ((value / total) * 100).toFixed(0) + "%";

                // Posisi teks
                var textX = Math.round((width - ctx.measureText(percentage).width) / 2),
                    textY = height / 2;

                // Gambar teks
                ctx.fillText(percentage, textX, textY);
                ctx.save();
            }

            // Registrasi plugin untuk semua doughnut charts
            Chart.plugins.register({
                afterDraw: function(chart) {
                    if (chart.config.type === 'doughnut') {
                        drawCenterText(chart);
                    }
                }
            });

            // Fungsi untuk membuat doughnut chart dengan data
            function createDoughnutChart(chartId, color, sesi, value, backgroundColor = "#E8EAED") {
                new Chart(document.getElementById(chartId), {
                    type: "doughnut",
                    data: {
                        labels: ["KARAKTER", ""],
                        datasets: [{
                            data: [value, sesi - value],
                            backgroundColor: [color, backgroundColor],
                            borderColor: "transparent"
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutoutPercentage: 65,
                        legend: {
                            display: false
                        },
                        tooltips: {
                            enabled: false // Disable tooltips
                        }
                    }
                });
            }

            $.ajax({
                url: "{{ url('admin/penilaian_pbi/data_penilaian_pbi_all') }}/" + tahun +
                        '/' + periode +
                        '/' + id_siswa +
                        '/' + guru +
                        '/' + id_kelas ,
                method: 'GET',
                success: function(response) {                    
                    createDoughnutChart("chartjs-bidang_studi", window.theme.primary, response.peserta.sesi_periode, response.jumlah_bidang_studi);
                    createDoughnutChart("chartjs-karakter", window.theme.warning, response.peserta.sesi_periode, response.jumlah_karakter);
                    createDoughnutChart("chartjs-amal", window.theme.danger, response.peserta.sesi_periode, response.jumlah_amal);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                }
            });
        });

    </script>
@endsection
