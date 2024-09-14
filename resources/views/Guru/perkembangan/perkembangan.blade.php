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
        .parent-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .parent-container canvas {
            max-width: 100%;
            max-height: 100%;
        }

        #charts-container {
            margin-bottom: 20px;
        }
        .chart-container {
            height: 350px;
            margin-bottom: 20px;
        }
    </style>
<main class="content">
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title" id="judul_header">
                STATISTIK PERKEMBANGAN PESERTA
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body border-navy mb-2">
                        <div class="row">
                            <div class="col-md-4 profile">
                                <div class="profile-item mb-3 d-flex justify-content-between">
                                    <span class="label text-end" style="flex: 1;">Nama</span>
                                    <span class="separator">:</span>
                                    <span class="value text-start" id="siswa" style="flex: 1;">-</span>
                                </div>
                                <div class="profile-item mb-3 d-flex justify-content-between">
                                    <span class="label text-end" style="flex: 1;">Orang Tua / Wali</span>
                                    <span class="separator">:</span>
                                    <span class="value text-start" id="orangtua" style="flex: 1;">-</span>
                                </div>
                                <div class="profile-item mb-3 d-flex justify-content-between">
                                    <span class="label text-end" style="flex: 1;">No. HP</span>
                                    <span class="separator">:</span>
                                    <span class="value text-start" id="nohp" style="flex: 1;">-</span>
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
                    <div class="card-body border-navy mb-2">
                        <div class="row">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">INDIKATOR</h5>
                                <form id="dataForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-12 col-xl-12">
                                            <label for="inputEmail4">Tahun Ajaran</label>
                                            <select class="form-control select2 mb-4 me-sm-2 mt-0"
                                                name="tahun_ajaran" data-bs-toggle="select2" required>
                                                <option>PILIH</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="table-container">
                                <div class="col-12 col-md-12">
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
                        </div>
                    </div>
                    <div class="card-body border-navy mb-2">
                        <div class="row">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Bina Pribadi Islam (BPI)</h5>
                                <div>
                                    <button id="prev-btn" class="btn btn-primary" disabled>Previous</button>
                                    <button id="next-btn" class="btn btn-primary">Next</button>
                                </div>
                            </div>
                            <div class="table-container">
                                <div class="col-12 col-md-12">
                                    <div id="charts-container" class="row">
                                        <!-- Chart containers will be appended here dynamically -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
    <!-- Your other content -->
    <script>
        var id = '{{ $id }}';
        $.ajax({
            url: `{{ url('guru/dashboard/data_perkembangan_peserta') }}/${id}`,
            type: 'GET',
            success: function(respons) {
                const data = respons.data;                  
                // Update identity-related fields
                const defaultImg = '{{ asset('assets/admin/img/avatars/avatar.jpg') }}';
                $('#siswa').text((data.peserta.nama_siswa || '').toUpperCase());
                $('#orangtua').text((data.peserta.orangtua_siswa || '').toUpperCase());
                $('#nohp').text((data.peserta.no_hp_siswa || '').toUpperCase());
                $('#avatarImg').attr('src', data.peserta.foto_siswa ? `{{ url('storage') }}/${data.peserta.foto_siswa}` : defaultImg);
            },
            error: function(xhr, status, error) {
                console.error(`AJAX Error: ${status} ${error}`);
            }
        });

        // grafik bina pribadi islam (BPI)
        document.addEventListener("DOMContentLoaded", function() {
            const selectedFields = [
                'alquran', 'aqidah', 'ibadah', 'hadits', 'sirah', 'tazkiyatun',
                'fikrul', 'aqdh', 'ibdh', 'akhlak', 'prbd', 'aqr', 'wwsn',
                'kwta', 'perkemahan', 'mbit', 'sholat_wajib', 'tilawah', 'tahajud',
                'duha', 'rawatib', 'dzikri', 'puasa', 'infaq'
            ];

            const siswaId = id; // Ensure `id` is defined and has a valid value
            const fieldTitles = {
                'alquran': 'ALQURAN', 'aqidah': 'AQIDAH', 'ibadah': 'IBADAH',
                'hadits': 'HADITS', 'sirah': 'SIRAH', 'tazkiyatun': 'TAZKIYATUN',
                'fikrul': 'FIKRUL', 'aqdh': 'AQDH', 'ibdh': 'IBDH', 'akhlak': 'AKHLAK',
                'prbd': 'PRBD', 'aqr': 'AQR', 'wwsn': 'WWSN', 'kwta': 'KWTA',
                'perkemahan': 'PERKEMAHAN', 'mbit': 'MBIT', 'sholat_wajib': 'SHOLAT WAJIB',
                'tilawah': 'TILAWAH', 'tahajud': 'TAHAJUD', 'duha': 'DUHA',
                'rawatib': 'RAWATIB', 'dzikri': 'DZIKRI', 'puasa': 'PUASA', 'infaq': 'INFAQ'
            };

            const chartsPerPage = 3;
            let currentPage = 0;
            let charts = [];

            function renderCharts() {
                const chartsContainer = document.getElementById('charts-container');
                chartsContainer.innerHTML = ''; // Clear any existing content

                const start = currentPage * chartsPerPage;
                const end = start + chartsPerPage;
                const chartsToShow = charts.slice(start, end);

                if (chartsToShow.length === 0) return;

                chartsToShow.forEach(chart => {
                    const colDiv = document.createElement('div');
                    colDiv.className = 'col-12 col-lg-4'; // Adjust column size as needed

                    const cardDiv = document.createElement('div');
                    cardDiv.className = 'card';

                    const cardHeader = document.createElement('div');
                    cardHeader.className = 'card-header';
                    const title = fieldTitles[chart.field] || 'Unknown Field';
                    cardHeader.innerHTML = `<h5 class="card-title text-center">${title}</h5>`;

                    const cardBody = document.createElement('div');
                    cardBody.className = 'card-body';

                    const chartContainer = document.createElement('div');
                    chartContainer.id = `chart-${chart.field}`;
                    chartContainer.style.marginBottom = '20px';
                    chartContainer.style.height = '350px';

                    cardBody.appendChild(chartContainer);
                    cardDiv.appendChild(cardHeader);
                    cardDiv.appendChild(cardBody);
                    colDiv.appendChild(cardDiv);
                    chartsContainer.appendChild(colDiv);

                    // Chart configuration
                    const chartOptions = {
                        chart: { height: 350, type: "bar" },
                        plotOptions: { bar: { horizontal: false } }, // Vertical bars
                        series: [{ name: `Nilai ${chart.field.charAt(0).toUpperCase() + chart.field.slice(1)}`, data: chart.data || [] }],
                        colors: ['#008000', '#0000FF', '#FFFF00'],
                        xaxis: { categories: chart.categories },
                        tooltip: { y: { formatter: val => val } },
                    };
                    const apexChart = new ApexCharts(chartContainer, chartOptions);
                    apexChart.render();
                });

                updateButtonState();
            }

            function updateButtonState() {
                document.getElementById('prev-btn').disabled = currentPage === 0;
                document.getElementById('next-btn').disabled = (currentPage + 1) * chartsPerPage >= charts.length;
            }

            fetch(`{{ url('guru/dashboard/data_grafik') }}/${siswaId}?fields=${selectedFields.join(',')}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.success || !data.data || !data.data.grafik_nilai) {
                        return;
                    }

                    const grafikNilai = data.data.grafik_nilai;
                    const tahunAjaran = grafikNilai.tahun_ajaran || [];
                    const periodeAjaran = grafikNilai.periode_ajaran || [];

                    const categories = tahunAjaran.map((tahun, index) => {
                        const semester = periodeAjaran[index] || '';
                        const semesterText = semester === 'ganjil' ? 'GANJIL' : 'GENAP'; 
                        return `${tahun} ${semesterText}`;
                    });

                    // Prepare charts data
                    charts = selectedFields.map(field => ({
                        field: field,
                        data: grafikNilai[field] || [],
                        categories: categories
                    }));

                    renderCharts();
                })
                .catch(error => console.error("Error fetching data:", error));

            document.getElementById('prev-btn').addEventListener('click', function() {
                if (currentPage > 0) {
                    currentPage--;
                    renderCharts();
                }
            });

            document.getElementById('next-btn').addEventListener('click', function() {
                if ((currentPage + 1) * chartsPerPage < charts.length) {
                    currentPage++;
                    renderCharts();
                }
            });
        });

        // grafik prosess persemester
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2();

            // Fetch data and populate the select element
            function fetchPeriodeData(id) {
                $.ajax({
                    url: '{{ url('guru/dashboard/data_peridoe') }}/' + id, // Replace with your API endpoint
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var $select = $('select[name="tahun_ajaran"]');
                        $select.empty().append('<option value="">PILIH</option>');

                        // Append new options
                        $.each(response.data.periode, function(index, item) {
                            var $option = $('<option>', {
                                value: item.id_rapor_pbi,
                                text: item.nama_tahun_ajaran + ' ' + item.jenis_kegiatan.toUpperCase()
                            });

                            if (item.status_tahun_ajaran === 1) {
                                $option.attr('selected', 'selected');
                            }

                            $select.append($option);
                        });


                        // Reinitialize Select2
                        $select.select2();
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch data:', error);
                    }
                });
            }

            // Handle change event for tahun_ajaran
            $('select[name="tahun_ajaran"]').on('change', function() {
                var selectedValue = $(this).val();
                console.log(selectedValue);
                
                if (selectedValue) {
                    fetchChartData(selectedValue);
                }
            });

            // Draw percentage in the center of the doughnut chart
            function drawCenterText(chart, value) {
                var width = chart.chart.width, height = chart.chart.height, ctx = chart.chart.ctx;
                ctx.restore();
                var fontSize = (height / 100).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = "middle";

                var percentage = value + "%";
                var textX = Math.round((width - ctx.measureText(percentage).width) / 2);
                var textY = height / 2;

                ctx.fillText(percentage, textX, textY);
                ctx.save();
            }

            // Register doughnut chart plugin for drawing center text
            Chart.plugins.register({
                afterDraw: function(chart) {
                    if (chart.config.type === 'doughnut') {
                        var value = chart.config.data.datasets[0].data[0];
                        drawCenterText(chart, value);
                    }
                }
            });

            // Create doughnut chart
            function createDoughnutChart(chartId, color, value, backgroundColor = "#E8EAED") {
                new Chart(document.getElementById(chartId), {
                    type: "doughnut",
                    data: {
                        labels: ["Value", ""],
                        datasets: [{
                            data: [value, 100 - value],
                            backgroundColor: [color, backgroundColor],
                            borderColor: "transparent"
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutoutPercentage: 65,
                        legend: { display: false },
                        tooltips: { enabled: false }
                    }
                });
            }

            // Fetch chart data based on selected tahun_ajaran
            function fetchChartData(selectedValue) {
                $.ajax({
                    url: "{{ url('guru/dashboard/data_peridoe_grafik') }}/" + id + '/' + selectedValue,
                    method: 'GET',
                    success: function(response) {                        
                        createDoughnutChart("chartjs-bidang_studi", window.theme.primary, response.data_grafik_home.total_bidang_studi);
                        createDoughnutChart("chartjs-karakter", window.theme.warning, response.data_grafik_home.total_karakter);
                        createDoughnutChart("chartjs-amal", window.theme.danger, response.data_grafik_home.total_amal);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching chart data:", error);
                    }
                });
            }

            // Initial data fetch
            fetchPeriodeData(id);
        });



    </script>
@endsection

