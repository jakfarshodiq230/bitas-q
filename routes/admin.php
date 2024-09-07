<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\AktifitasAmalController;
use App\Http\Controllers\Admin\PeriodeController;
use App\Http\Controllers\Admin\PesertaKegiatanController;
use App\Http\Controllers\Admin\PenilaianKegiatanController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\PeriodeRaporController;
use App\Http\Controllers\Admin\PesertaRaporController;
use App\Http\Controllers\Admin\KopController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SetingMailController;
use App\Http\Controllers\Admin\PeriodeSertifikasiController;
use App\Http\Controllers\Admin\PesertaSertifikasiController;
use App\Http\Controllers\Admin\RekapController;
use App\Http\Controllers\Admin\PeriodePbiController;
use App\Http\Controllers\Admin\PesertaPbiController;
use App\Http\Controllers\Admin\PenilaianPbiController;
use App\Http\Controllers\Admin\PeriodeRaporPbiController;
use App\Http\Controllers\Admin\PesertaRaporPbiController;
use App\Http\Controllers\Admin\DashboardController as DashboardControllerAdmin;


Route::group(['middleware' => ['auth:users']], function () {

    Route::prefix('admin/dashboard')->group(function () {
        Route::get('/', [DashboardControllerAdmin::class, 'index'])->name('dashboard.home');
        Route::get('/data_home_default', [DashboardControllerAdmin::class, 'AjaxDataPeriode'])->name('dashboard.AjaxDataPeriode');
        Route::get('/log', [DashboardControllerAdmin::class, 'LogLogin'])->name('dashboard.LogLogin');
        Route::get('/data_home_log', [DashboardControllerAdmin::class, 'AjaxDataLog'])->name('dashboard.AjaxDataLog');
        Route::get('/histori', [DashboardControllerAdmin::class, 'Histori'])->name('dashboard.Histori');
        Route::get('/ajax_histori', [DashboardControllerAdmin::class, 'AjaxHistoriTahun'])->name('dashboard.AjaxHistoriTahun');
        Route::get('/ajax_histori_peserta/{id}', [DashboardControllerAdmin::class, 'AjaxHistoriPeserta'])->name('dashboard.AjaxHistoriPeserta');
        Route::get('/ajax_data_histori/{id}/{tahun}', [DashboardControllerAdmin::class, 'AjaxDataHistori'])->name('dashboard.AjaxDataHistori');
    });

    Route::prefix('admin')->controller(SetingMailController::class)->group(function () {
        Route::get('email', 'index');
        Route::get('email/data_email', 'AjaxData');
        Route::post('email/update_email/{id}', 'updateData');
    });

    Route::prefix('admin')->controller(SiswaController::class)->group(function () {
        Route::get('siswa', 'index');
        Route::get('siswa/data_siswa', 'AjaxData');
        Route::get('siswa/edit_siswa/{id}', 'editData');
        Route::post('siswa/store_siswa', 'storeData');
        Route::post('siswa/update_siswa/{id}', 'updateData');
        Route::delete('siswa/delete_siswa/{id}', 'deleteData');
        Route::put('siswa/status_siswa/{id}/{status}', 'statusData');
        Route::post('siswa/import_siswa', 'importExcel');
        Route::post('siswa/seting_siswa', 'setingData');
    });

    Route::prefix('admin')->controller(GuruController::class)->group(function () {
        Route::get('guru', 'index');
        Route::get('guru/data_guru', 'AjaxData');
        Route::get('guru/edit_guru/{id}', 'editData');
        Route::post('guru/store_guru', 'storeData');
        Route::post('guru/update_guru/{id}', 'updateData');
        Route::delete('guru/delete_guru/{id}', 'deleteData');
        Route::put('guru/status_guru/{id}/{status}', 'statusData');
        Route::post('guru/import_guru', 'importExcel');
        Route::post('guru/seting_guru', 'setingData');
        Route::get('guru/pesan_email_guru/{id}', 'SendEmail');
    });

    Route::prefix('admin')->controller(KelasController::class)->group(function () {
        Route::get('kelas', 'index');
        Route::get('kelas/data_kelas', 'AjaxData');
        Route::get('kelas/edit_kelas/{id}', 'editData');
        Route::post('kelas/store_kelas', 'storeData');
        Route::post('kelas/update_kelas/{id}', 'updateData');
        Route::delete('kelas/delete_kelas/{id}', 'deleteData');
        Route::put('kelas/status_kelas/{id}/{status}', 'statusData');
    });

    Route::prefix('admin')->controller(UnitController::class)->group(function () {
        Route::get('unit', 'index');
        Route::get('unit/data_unit', 'AjaxData');
        Route::get('unit/edit_unit/{id}', 'editData');
        Route::post('unit/store_unit', 'storeData');
        Route::post('unit/update_unit/{id}', 'updateData');
        Route::delete('unit/delete_unit/{id}', 'deleteData');
        Route::put('unit/status_unit/{id}/{status}', 'statusData');
    });

    Route::prefix('admin')->controller(TahunAjaranController::class)->group(function () {
        Route::get('tahun_ajaran', 'index');
        Route::get('tahun_ajaran/data_tahun_ajaran', 'AjaxData');
        Route::get('tahun_ajaran/edit_tahun_ajaran/{id}', 'editData');
        Route::post('tahun_ajaran/store_tahun_ajaran', 'storeData');
        Route::post('tahun_ajaran/update_tahun_ajaran/{id}', 'updateData');
        Route::delete('tahun_ajaran/delete_tahun_ajaran/{id}', 'deleteData');
        Route::put('tahun_ajaran/status_tahun_ajaran/{id}/{status}', 'statusData');
    });

    Route::prefix('admin')->controller(PeriodeController::class)->group(function () {
        Route::get('periode', 'index');
        Route::get('periode/data_tahun', 'AjaxDataTahun');
        Route::get('periode/data_periode', 'AjaxData');
        Route::get('periode/edit_periode/{id}', 'editData');
        Route::post('periode/store_periode', 'storeData');
        Route::post('periode/update_periode/{id}', 'updateData');
        Route::delete('periode/delete_periode/{id}', 'deleteData');
        Route::put('periode/status_periode/{id}/{status}', 'statusData');
    });

    Route::prefix('admin')->controller(PesertaKegiatanController::class)->group(function () {
        Route::get('peserta', 'index');
        Route::get('peserta/data_periode_peserta', 'AjaxDataPeriode');
        Route::get('peserta/data_list_periode_peserta/{periode}/{tahun}', 'DataListPesertaKegiatan');
        Route::get('peserta/data_peserta/{periode}/{tahun}', 'AjaxData');
        Route::get('peserta/data_siswa/{tahun}/{periode}', 'AjaxDataSiswa');
        Route::get('peserta/edit_peserta/{id}', 'editData');
        Route::post('peserta/store_peserta', 'storeData');
        Route::post('peserta/update_peserta/{id}', 'updateData');
        Route::delete('peserta/delete_peserta/{id}', 'deleteData');
        Route::put('peserta/status_peserta/{id}/{status}', 'statusData');
        Route::put('peserta/status_peserta_all/{tahun}/{periode}/{status}', 'statusDataAll');
    });

    Route::prefix('admin')->controller(PenilaianKegiatanController::class)->group(function () {
        Route::get('penilaian_kegiatan', 'index');
        Route::get('penilaian_kegiatan/data_periode_penilaian_kegiatan', 'AjaxDataPeriode');
        Route::get('penilaian_kegiatan/data_list_periode_penilaian_kegiatan/{periode}/{tahun}', 'DataListPenilaianKegiatan');
        Route::get('penilaian_kegiatan/data_penilaian_kegiatan/{periode}/{tahun}', 'AjaxData');
        Route::get('penilaian_kegiatan/data_detail_periode_penilaian_kegiatan/{tahun}/{periode}/{siswa}/{guru}/{kelas}', 'DataDetailPenilaianKegiatan');
        Route::get('penilaian_kegiatan/data_penilaian_kegiatan_all/{tahun}/{periode}/{siswa}/{guru}/{kelas}', 'AjaxDataDetailPenilaianKegiatan');
    });

    Route::prefix('admin')->controller(PeriodePbiController::class)->group(function () {
        Route::get('periode_pbi', 'index');
        Route::get('periode_pbi/data_tahun', 'AjaxDataTahun');
        Route::get('periode_pbi/data_periode_pbi', 'AjaxData');
        Route::get('periode_pbi/edit_periode_pbi/{id}', 'editData');
        Route::post('periode_pbi/store_periode_pbi', 'storeData');
        Route::post('periode_pbi/update_periode_pbi/{id}', 'updateData');
        Route::delete('periode_pbi/delete_periode_pbi/{id}', 'deleteData');
        Route::put('periode_pbi/status_periode_pbi/{id}/{status}', 'statusData');
        Route::get('periode_pbi/peserta_periode_pbi/{tahun}/{pbi}/{periode}', 'PesertaPbi');
    });

    Route::prefix('admin')->controller(PenilaianPbiController::class)->group(function () {
        Route::get('penilaian_pbi', 'index');
        Route::get('penilaian_pbi/data_periode_penilaian_pbi', 'AjaxDataPeriode');
        Route::get('penilaian_pbi/data_list_periode_penilaian_pbi/{periode}/{tahun}', 'DataListPenilaianKegiatan');
        Route::get('penilaian_pbi/data_penilaian_pbi/{periode}/{tahun}', 'AjaxData');
        Route::get('penilaian_pbi/data_detail_periode_penilaian_pbi/{tahun}/{periode}/{siswa}/{guru}/{kelas}', 'DataDetailPenilaianKegiatan');
        Route::get('penilaian_pbi/data_penilaian_pbi_all/{tahun}/{periode}/{siswa}/{guru}/{kelas}', 'AjaxDataDetailPenilaianKegiatan');
    });

    Route::prefix('admin')->controller(PesertaPbiController::class)->group(function () {
        Route::get('peserta_pbi', 'index');
        Route::get('peserta_pbi/data_periode_peserta_pbi', 'AjaxDataPeriode');
        Route::get('peserta_pbi/data_list_periode_peserta_pbi/{periode}/{tahun}', 'DataListPesertaPbi');
        Route::get('peserta_pbi/data_peserta_pbi/{periode}/{tahun}', 'AjaxData');
        Route::get('peserta_pbi/data_siswa/{tahun}/{periode}', 'AjaxDataSiswa');
        Route::get('peserta_pbi/edit_peserta_pbi/{id}', 'editData');
        Route::post('peserta_pbi/store_peserta_pbi', 'storeData');
        Route::post('peserta_pbi/update_peserta_pbi/{id}', 'updateData');
        Route::delete('peserta_pbi/delete_peserta_pbi/{id}', 'deleteData');
        Route::put('peserta_pbi/status_peserta_pbi/{id}/{status}', 'statusData');
        Route::put('peserta_pbi/status_peserta_pbi_all/{tahun}/{periode}/{status}', 'statusDataAll');
    });

    Route::prefix('admin')->controller(PeriodeRaporPbiController::class)->group(function () {
        Route::get('periode_rapor_pbi', 'index');
        Route::get('periode_rapor_pbi/data_tahun', 'AjaxDataTahun');
        Route::get('periode_rapor_pbi/data_periode_rapor_pbi', 'AjaxData');
        Route::get('periode_rapor_pbi/edit_periode_rapor_pbi/{id}', 'editData');
        Route::post('periode_rapor_pbi/store_periode_rapor_pbi', 'storeData');
        Route::post('periode_rapor_pbi/update_periode_rapor_pbi/{id}', 'updateData');
        Route::delete('periode_rapor_pbi/delete_periode_rapor_pbi/{id}', 'deleteData');
        Route::put('periode_rapor_pbi/status_periode_rapor_pbi/{id}/{status}', 'statusData');
        Route::get('periode_rapor_pbi/peserta_periode_rapor_pbi/{tahun}/{rapor}/{periode}', 'PesertaRaport');
    });

    Route::prefix('admin')->controller(PesertaRaporPbiController::class)->group(function () {
        Route::get('/peserta_rapor_pbi/cetak_rapor_admin/{param1}/{param2}/{param3}/{param4}/{param5}', 'CetakRaporPdf');
        Route::get('peserta_rapor_pbi', 'index');
        Route::get('peserta_rapor_pbi/data_peserta_rapor_pbi', 'AjaxData');
        Route::get('peserta_rapor_pbi/sync/{tahun}/{rapor}/{peserta}', 'SyncRapor');
        Route::get('peserta_rapor_pbi/list_peserta/{tahun}/{rapor}/{periode}', 'DataPeserta');
        Route::get('peserta_rapor_pbi/ajax_list_peserta/{tahun}/{rapor}/{periode}', 'AjaxDataPesertaRapor');
        Route::get('peserta_rapor_pbi/detail_peserta/{id}/{peserta}/{tahun}/{rapor}/{periode}', 'DataDetailPeserta');
        Route::get('peserta_rapor_pbi/ajax_detail_peserta/{id}/{peserta}/{tahun}/{rapor}/{periode}', 'AjaxDataDetailPesertaRapor');
        
    });

    Route::prefix('admin')->controller(PeriodeRaporController::class)->group(function () {
        Route::get('periode_rapor', 'index');
        Route::get('periode_rapor/data_tahun', 'AjaxDataTahun');
        Route::get('periode_rapor/data_periode_rapor', 'AjaxData');
        Route::get('periode_rapor/edit_periode_rapor/{id}', 'editData');
        Route::post('periode_rapor/store_periode_rapor', 'storeData');
        Route::post('periode_rapor/update_periode_rapor/{id}', 'updateData');
        Route::delete('periode_rapor/delete_periode_rapor/{id}', 'deleteData');
        Route::put('periode_rapor/status_periode_rapor/{id}/{status}', 'statusData');
        Route::get('periode_rapor/peserta_periode_rapor/{tahun}/{rapor}/{periode}', 'PesertaRaport');
    });

    Route::prefix('admin')->controller(PesertaRaporController::class)->group(function () {
        Route::get('/peserta_rapor/cetak_rapor_admin/{param1}/{param2}/{param3}/{param4}/{param5}', 'CetakRaporPdf');
        Route::get('peserta_rapor', 'index');
        Route::get('peserta_rapor/data_peserta_rapor', 'AjaxData');
        Route::get('peserta_rapor/sync/{tahun}/{rapor}/{peserta}', 'SyncRapor');
        Route::get('peserta_rapor/list_peserta/{tahun}/{rapor}/{periode}', 'DataPeserta');
        Route::get('peserta_rapor/ajax_list_peserta/{tahun}/{rapor}/{periode}', 'AjaxDataPesertaRapor');
        Route::get('peserta_rapor/detail_peserta/{id}/{peserta}/{tahun}/{rapor}/{periode}', 'DataDetailPeserta');
        Route::get('peserta_rapor/ajax_detail_peserta/{id}/{peserta}/{tahun}/{rapor}/{periode}', 'AjaxDataDetailPesertaRapor');
        
    });

    Route::prefix('admin')->controller(PeriodeSertifikasiController::class)->group(function () {
        Route::get('periode_sertifikasi', 'index');
        Route::get('periode_sertifikasi/data_tahun', 'AjaxDataTahun');
        Route::get('periode_sertifikasi/data_periode_sertifikasi', 'AjaxData');
        Route::get('periode_sertifikasi/edit_periode_sertifikasi/{id}', 'editData');
        Route::post('periode_sertifikasi/store_periode_sertifikasi', 'storeData');
        Route::post('periode_sertifikasi/update_periode_sertifikasi/{id}', 'updateData');
        Route::delete('periode_sertifikasi/delete_periode_sertifikasi/{id}', 'deleteData');
        Route::put('periode_sertifikasi/status_periode_sertifikasi/{id}/{status}', 'statusData');
        Route::get('periode_sertifikasi/peserta_periode_sertifikasi/{tahun}/{rapor}/{periode}', 'PesertaRaport');
        Route::get('periode_sertifikasi/test_sertifikat/{id}', 'TestSertifikat');
    });

    Route::prefix('admin')->controller(PesertaSertifikasiController::class)->group(function () {
        Route::get('peserta_sertifikasi', 'index');
        Route::get('peserta_sertifikasi/data_peserta_sertifikasi', 'AjaxData');
        Route::get('peserta_sertifikasi/list_peserta/{tahun}/{rapor}/{periode}', 'DataPeserta');
        Route::get('peserta_sertifikasi/ajax_list_peserta/{tahun}/{rapor}/{periode}', 'AjaxDataPesertaSertifikasi');
        Route::post('peserta_sertifikasi/ajax_store_peserta/', 'StoreData');
        Route::post('peserta_sertifikasi/ajax_reset_peserta/{id}/{peserta}/{tahun}/{periode}', 'ResetData');
        Route::get('peserta_sertifikasi/detail_peserta/{id}', 'DataDetailPeserta');
        Route::get('peserta_sertifikasi/ajax_detail_peserta/{id}', 'AjaxDataDetailPesertaSertif');
        Route::get('peserta_sertifikasi/cetak_sertifikat/{id}','CetakSertifikat');
        Route::get('peserta_sertifikasi/download_sertifikat/{id}','CetakSertifikatPdf');
        
    });

    Route::prefix('admin/kop')->group(function () {
        Route::get('/', [KopController::class, 'index'])->name('admin.kop.index');
        Route::post('/ajax_upload_kop', [KopController::class, 'storeData'])->name('admin.kop.storeData');
        Route::get('/ajax_view_kop', [KopController::class, 'AjaxData'])->name('admin.kop.AjaxData');
    });

    Route::prefix('admin/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/ajax_data_users', [UserController::class, 'AjaxData'])->name('admin.users.AjaxData');
        Route::post('/ajax_store_users', [UserController::class, 'AjaxStoreData'])->name('admin.users.AjaxStoreData');
        Route::get('/ajax_edit_users/{id}', [UserController::class, 'AjaxEditData'])->name('admin.users.AjaxEditData');
        Route::post('/ajax_update_users/{id}', [UserController::class, 'AjaxUpdateData'])->name('admin.users.AjaxUpdateData');
        Route::delete('/ajax_delete_users/{id}', [UserController::class, 'AjaxDeleteData'])->name('admin.users.AjaxDeleteData');
        Route::put('/ajax_status_users/{id}/{status}', [UserController::class, 'AjaxStatusData'])->name('admin.users.AjaxStatusData');
    });

    Route::prefix('admin/mail')->group(function () {
        Route::get('/', [SetingMailController::class, 'index'])->name('admin.mail.index');
        Route::post('/ajax_update_mail/{id}', [SetingMailController::class, 'AjaxUpdateData'])->name('admin.mail.AjaxUpdateData');
        Route::post('/ajax_test_mail/{email}', [SetingMailController::class, 'AjaxTesEmail'])->name('admin.mail.AjaxTesEmail');
    });

    Route::prefix('admin')->group(function () {
        Route::get('rekap/rapor', [RekapController::class, 'index'])->name('admin.rekap-rapor.index');
        Route::get('rekap/rapor/periode', [RekapController::class, 'periode'])->name('admin.rekap-rapor.periode');
        Route::get('rekap/rapor/download/{IdPeriode}/{IdKelas}', [RekapController::class, 'cetakExcel'])->name('admin.rekap-rapor.cetakExcel');

        Route::get('rekap/kegiatan', [RekapController::class, 'kegiatan'])->name('admin.rekap-kegiatan.kegiatan');
        Route::get('rekap/kegiatan/periode_kegiatan', [RekapController::class, 'PeriodeKegiatan'])->name('admin.rekap-kegiatan.PeriodeKegiatan');
        Route::get('rekap/kegiatan/siswa_kegiatan/{IdPeriode}/{IdKelas}', [RekapController::class, 'SiswaKegiatan'])->name('admin.rekap-kegiatan.SiswaKegiatan');
        Route::get('rekap/kegiatan/download/{IdPeriode}/{IdKelas}/{idSiswa}', [RekapController::class, 'cetakExcelKegiatan'])->name('admin.rekap-kegiatan.cetakExcelKegiatan');

        Route::get('rekap/sertifikasi', [RekapController::class, 'sertifikasi'])->name('admin.rekap-sertifikasi.sertifikasi');
        Route::get('rekap/sertifikasi/periode_sertifikasi', [RekapController::class, 'PeriodeSertifikasi'])->name('admin.rekap-sertifikasi.PeriodeSertifikasi');
        Route::get('rekap/sertifikasi/download/{IdPeriode}', [RekapController::class, 'cetakExcelsertifikasi'])->name('admin.rekap-sertifikasi.cetakExcelsertifikasi');
    });

});
