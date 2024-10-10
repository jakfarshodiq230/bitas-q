@extends('Siswa.layout')
@section('content')
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title" id="judul_header">
                    FORM BINA PRIBADI ISLAM (BPI) MANDIRI
                </h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <form id="smartwizard-validation" class="wizard wizard-primary" action="javascript:void(0)">
                        <ul class="nav">
                            <li class="nav-item"><a class="nav-link" href="#validation-step-1">IDENTITAS<br /><small>1</small></a></li>
                            <li class="nav-item"><a class="nav-link" href="#validation-step-2">AKTIFITAS AMAL<br /><small>2</small></a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="validation-step-1" class="tab-pane larger-height" role="tabpanel" style="height: 350px;">
                                <div class="form-group mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-end">Tahun Pelajaran
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input name="wizard-tahun" value="{{ $periode->nama_tahun_ajaran }} {{ strtoupper($periode->jenis_kegiatan) }} [ {{ $periode->sesi_periode}} PEKAN ]" type="text" class="form-control  required" readonly>
                                        <input name="wizard-peserta" value="{{ $periode->id_peserta_pbi}}" type="text" class="form-control  required" hidden>
                                        <input name="wizard-guru" value="{{ $periode->id_guru}}" type="text" class="form-control  required" hidden>
                                        <input name="wizard-sesi" value="{{ $periode->sesi_periode}}" type="text" class="form-control  required" hidden>
                                        <input name="wizard-id-tahun" value="{{ $periode->id_tahun_ajaran}}" type="text" class="form-control  required" hidden>
                                        <input name="wizard-id-periode" value="{{ $periode->id_periode}}" type="text" class="form-control  required" hidden>
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-end">Pekan
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="wizard-pekan" class="form-control required select2" id="wizard-pekan">
                                            <option value="" disabled selected>PILIH PEKAN KE</option>
                                            @for($i = 1; $i <= $periode->sesi_periode; $i++)
                                                <option value="{{ $i }}">PEKAN {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-end">Tanggal
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input name="wizard-tanggal" type="date" class="form-control  required">
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="col-form-label col-sm-2 text-sm-end">List Pekan Sudah Terisi <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="row" id="checkbox-container"></div>
                                    </div>
                                </div>
                            </div>
                            <div id="validation-step-2" class="tab-pane" role="tabpanel">
                                <div class="form-group mb-3 row">
                                    <label class="col-form-label col-sm-4 text-sm-end">Shalat wajib 5 Waktu berjamaah (putra: di masjid dan tepat waktu untuk putri)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input name="wizard-wajib" type="number" class="form-control  required" placeholder="Jumlah  kali/pekan" min="1" max="30">
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="col-form-label col-sm-4 text-sm-end">Tilawah  Al-Qur'an
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input name="wizard-tilawah" type="number" class="form-control  required" placeholder="Jumlah  halaman/pekan" min="1" max="30">
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="col-form-label col-sm-4 text-sm-end">Shalat Tahajud/Qiyamul Lail
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input name="wizard-tahajud" type="number" class="form-control  required" placeholder="Jumlah  kali/pekan" min="1" max="30">
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="col-form-label col-sm-4 text-sm-end">Shalat Dhuha
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input name="wizard-dhuha" type="number" class="form-control  required" placeholder="Jumlah  kali/pekan" min="1" max="30">
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="col-form-label col-sm-4 text-sm-end">Shalat Rawatib
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input name="wizard-rawatib" type="number" class="form-control  required" placeholder="Jumlah  kali/pekan" min="1" max="30">
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="col-form-label col-sm-4 text-sm-end">Dzikir Pagi/Sore
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input name="wizard-dzikri" type="number" class="form-control  required" placeholder="Jumlah  kali/pekan" min="1" max="30">
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="col-form-label col-sm-4 text-sm-end">Puasa Sunah
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input name="wizard-puasa" type="number" class="form-control  required" placeholder="Jumlah  kali/pekan" min="1" max="30">
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="col-form-label col-sm-4 text-sm-end">Infaq
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input name="wizard-infaq" type="number" class="form-control  required" placeholder="Jumlah  kali/pekan" min="1" max="30">
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="custom-control custom-checkbox col-form-label col-sm-12 text-sm-start">
                                        <span class="custom-control-label">Saya menyatakan bahwa data ini benar dan sesuai dengan yang saya kerjakan. Apabila di kemudian hari terbukti tidak sesuai, saya bersedia menerima segala konsekuensi yang ditetapkan.</span>
                                        <input type="checkbox" id="terms-checkbox" class="custom-control-input">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Initialize SmartWizard for different themes
    const wizardConfigs = [
        "#smartwizard-default-primary",
        "#smartwizard-default-success",
        "#smartwizard-default-danger",
        "#smartwizard-default-warning",
        "#smartwizard-arrows-primary",
        "#smartwizard-arrows-success",
        "#smartwizard-arrows-danger",
        "#smartwizard-arrows-warning"
    ];
    wizardConfigs.forEach(function (selector) {
        $(selector).smartWizard({
            theme: selector.includes("arrows") ? "arrows" : "default",
            showStepURLhash: false
        });
    });

    // Enable or disable submit button based on checkbox
    $('#terms-checkbox').on('change', function () {
        $('.btn-submit').prop('disabled', !this.checked);
    });

    // Validation setup
    const $validationForm = $("#smartwizard-validation");
    $validationForm.validate({
        errorPlacement: function (error, element) {
            $(element).parents(".error-placeholder").append(error.addClass("invalid-feedback small d-block"));
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        }
    });

    // SmartWizard with validation
    $validationForm.smartWizard({
        autoAdjustHeight: false,
        backButtonSupport: false,
        useURLhash: false,
        toolbarSettings: {
            toolbarExtraButtons: [$("<button class=\"btn btn-submit btn-primary\" type=\"button\" disabled>Simpan</button>")]
        }
    }).on("leaveStep", function (e, anchorObject, stepNumber, stepDirection) {
        return stepDirection === 1 ? $validationForm.valid() : true;
    });

    // Setup AJAX with CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Submit form via AJAX
    $validationForm.find(".btn-submit").on("click", function (e) {
        e.preventDefault();

        if (!$validationForm.valid()) return;

        const $submitButton = $(this);
        const originalButtonText = $submitButton.text();
        $submitButton.prop('disabled', true).text('Proses...');

        $.ajax({
            url: '{{ url('siswa/bpi/ajax-simpan-mandiri') }}',
            type: 'POST',
            data: $validationForm.serialize(),
            success: function (response) {
                fetchAndRenderCheckboxes();
                $('.select2').val(null).trigger('change');
                Swal.fire({
                    title: response.success ? 'Success' : 'Error',
                    text: response.message,
                    icon: response.success ? 'success' : 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    if (response.success) $validationForm[0].reset();
                });
            },
            error: function () {
                Swal.fire({
                    title: 'Error',
                    text: 'There was an issue submitting the form.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            },
            complete: function () {
                $submitButton.prop('disabled', false).text(originalButtonText);
            }
        });
    });


    function fetchAndRenderCheckboxes() {
        $.ajax({
            url: '{{ url('siswa/bpi/ajax-listpekan-mandiri') }}/',
            method: 'GET',
            success: function(response) {
                console.log("AJAX Response:", response); // Log the entire response for debugging
                $('#checkbox-container').empty();

                // Iterate through the response to create checkboxes
                response.data.forEach((item, index) => {
                    const checkboxId = `session-${item.pekan_amal}`;
                    const isChecked = item.checked ? 'checked' : '';
                    let isPenilain;

                    if (item.jenis_pengisian_amal === 'mandiri') {
                        isPenilain = 'MANDIRI';
                    } else if (item.jenis_pengisian_amal === 'guru') {
                        isPenilain = 'PEMBINA';
                    } else {
                        isPenilain = '-';
                    }

                    // Create a wrapper for the checkbox and label
                    const checkboxHtml = `
                        <div class="col-sm-4 mb-2"> <!-- Three columns -->
                            <input type="checkbox" id="${checkboxId}" style="background-color: green;" ${isChecked} disabled/>
                            <label for="${checkboxId}">
                                <span>PEKAN KE- ${item.pekan_amal} ( ${isPenilain} )</span>
                            </label>
                        </div>
                    `;

                    // Append the checkbox HTML to the container
                    $('#checkbox-container').append(checkboxHtml);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }
    fetchAndRenderCheckboxes();



});
</script>
