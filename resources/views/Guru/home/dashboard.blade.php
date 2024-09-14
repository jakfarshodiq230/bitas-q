@extends('Guru.layout')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/tutorials/timelines/timeline-7/assets/css/timeline-7.css">
<main class="content">
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title" id="judul_header">
            SELAMAT DATANG {{ ucfirst(strtolower(session('user')['nama_user'])) }},  DI BITAS-Q.
            </h1>
            <p class="header-subtitle">BITAS-Q merupakan sistem informasi dan manajemen Tahsin, Tahfidz, Sertifikasi Al-Qur'an dan Bina Pribadi Islam (BPI).</p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Timeline Kegiatan</h4>
                        <!-- Timeline 7 - Bootstrap Brain Component -->
                        <div class="bsb-timeline-7 bg-light">
                            <div class="row justify-content-center">
                                <div class="col-10 col-md-12 col-xl-10 col-xxl-9">
                                    <ul class="timeline">
                                        
                                    </ul>
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
<script>
    $(document).ready(function() {
    // Function to load events
        const now = new Date();
        const options2 = { month: 'long', year: 'numeric'};
        const options1 = { month: 'long'};                        
        const options3 = { 
            day: 'numeric', 
            month: 'long', 
            year: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            hour12: false // Use 24-hour format; set to true for 12-hour format
        };
        function capitalizeFirstLetter(str) {
            if (typeof str !== 'string' || str.length === 0) return str;
            return str.charAt(0).toUpperCase() + str.slice(1);
        }
        function loadEvents() {
            $.ajax({
                url: '{{ url('guru/dashboard/ajax_data_dashboard') }}',
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var eventList = $('.timeline').empty(); 
                    
                    $.each(response.data, function(index, event) {
                        var bulan_start = new Date(event.created_at).toLocaleDateString('id-ID', options1);
                        var bulan_end = new Date(event.tggl_akhir_penilaian).toLocaleDateString('id-ID', options2);
                        var batas_penilaian = new Date(event.tggl_akhir_penilaian).toLocaleDateString('id-ID', options3);

                        var title = (event.judul_periode === 'rapor')
                            ? `${event.judul_periode.toUpperCase()} ${(event.jenis_periode === 'pbi') ? 'BINA PRIBADI ISLAM (BPI)' : event.jenis_periode.toUpperCase()}`
                            : `${event.judul_periode.toUpperCase()} ${event.jenis_periode.toUpperCase()}${event.judul_periode === 'sertifikasi' ? ' JUZ ' + event.juz_periode : ''}`;
                        
                        var eventStatus = event.status_periode === 0 ? 'TUTUP PENDAFTARAN' : 'BUKA PENDAFTARAN';
                        var batasStatus = event.tggl_akhir_penilaian < new Date() ? 'bg-danger' : 'bg-success';

                        var commonHtml = `
                            <li class="timeline-item">
                                <div class="timeline-body">
                                    <div class="timeline-meta">
                                        <div class="d-inline-flex flex-column px-2 py-1 text-success-emphasis ${event.judul_periode === 'rapor' ? 'bg-success-subtle' : 'bg-danger-subtle'} border border-success-subtle rounded-2 text-md-end">
                                            <span class="fw-bold">${event.judul_periode.toUpperCase()}</span>
                                            <span>${bulan_start} - ${bulan_end}</span>
                                        </div>
                                    </div>
                                    <div class="timeline-content timeline-indicator">
                                        <div class="card border-0 shadow">
                                            <div class="card-body p-sm-2">
                                                <h2 class="card-title mb-2">${title}</h2>`;

                        var contentHtml = (event.jenis_periode === 'pbi')
                            ? `<p class="card-text m-0">Rapor Bina Pribadi Islam (BPI) sudah dapat dicetak Mulai Tanggal <span class="badge ${batasStatus}">${batas_penilaian}</span><br> </p>`
                            : `<p class="card-text m-0">Pendaftaran <span class="badge ${event.status_periode === 0 ? 'bg-danger' : 'bg-success'}">${eventStatus}</span><br>
                            Batas Penilaian <span class="badge ${batasStatus}">${batas_penilaian}</span><br>
                            Segera lakukan penilaian sebelum waktu masa penilaian berakhir.</p>`;

                        var eventItem = `${commonHtml}${contentHtml}</div></div></div></li>`;
                        
                        eventList.append(eventItem);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error loading events:', status, error);
                }
            });
        }


        // Load events on page load
        loadEvents();
    });

</script>
@endsection


