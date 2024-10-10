<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Siswa\DashboardControllerSiswa;
use App\Http\Controllers\Siswa\AlquranControllerSiswa;
use App\Http\Controllers\Siswa\BpiControllerSiswa;
use App\Http\Controllers\Siswa\SertifikasiControllerSiswa;

Route::middleware('auth:siswa')->group(function () {
    Route::prefix('siswa/dashboard')->group(function () {
        Route::get('/', [DashboardControllerSiswa::class, 'index'])->name('siswa.home');
        Route::get('/ajax_data_dashboard', [DashboardControllerSiswa::class, 'AjaxData'])->name('siswa.AjaxData');
    });

    Route::prefix('siswa/kegiatan')->group(function () {
        Route::get('/', [AlquranControllerSiswa::class, 'index'])->name('siswa.kegiatan');
        Route::get('/ajax-data-periode', [AlquranControllerSiswa::class, 'AjaxDataPeriode'])->name('siswa.AjaxDataPeriode');
        Route::get('/detail-nilai/{periode}', [AlquranControllerSiswa::class, 'DetailNilai'])->name('siswa.DetailNilai');
        Route::get('/ajax-nilai/{periode}', [AlquranControllerSiswa::class, 'AjaxNilai'])->name('siswa.AjaxNilai');
        Route::get('/downloadRapor/{periode}/{jenjang}', [AlquranControllerSiswa::class, 'downloadRapor'])->name('siswa.downloadRapor');
    });

    Route::prefix('siswa/bpi')->group(function () {
        Route::get('/', [BpiControllerSiswa::class, 'index'])->name('siswa.kegiatan');
        Route::get('/ajax-data-periode', [BpiControllerSiswa::class, 'AjaxDataPeriode'])->name('siswa.AjaxDataPeriode');
        Route::get('/detail-nilai/{periode}', [BpiControllerSiswa::class, 'DetailNilai'])->name('siswa.DetailNilai');
        Route::get('/ajax-nilai/{periode}', [BpiControllerSiswa::class, 'AjaxNilai'])->name('siswa.AjaxNilai');
        Route::get('/downloadRapor/{periode}', [BpiControllerSiswa::class, 'downloadRapor'])->name('siswa.downloadRapor');

        Route::get('/mandiri_bpi', [BpiControllerSiswa::class, 'IsiMandiri'])->name('siswa.IsiMandiri');
        Route::post('/ajax-simpan-mandiri', [BpiControllerSiswa::class, 'AjaxSimpanMandiri'])->name('siswa.AjaxSimpanMandiri');
        Route::get('/ajax-nilai-mandiri', [BpiControllerSiswa::class, 'AjaxNilaiMandiri'])->name('siswa.AjaxNilaiMandiri');
        Route::get('/ajax-listpekan-mandiri', [BpiControllerSiswa::class, 'AjaxPekanListMandiri'])->name('siswa.AjaxPekanListMandiri');
    });

    Route::prefix('siswa/sertifikasi')->group(function () {
        Route::get('/', [SertifikasiControllerSiswa::class, 'index'])->name('siswa.kegiatan');
        Route::get('/ajax-data-periode', [SertifikasiControllerSiswa::class, 'AjaxDataPeriode'])->name('siswa.AjaxDataPeriode');
        Route::get('/detail-nilai/{periode}', [SertifikasiControllerSiswa::class, 'DetailNilai'])->name('siswa.DetailNilai');
        Route::get('/ajax-nilai/{periode}', [SertifikasiControllerSiswa::class, 'AjaxNilai'])->name('siswa.AjaxNilai');
        Route::get('/downloadKartu/{id}', [SertifikasiControllerSiswa::class, 'downloadKartu'])->name('siswa.downloadKartu');
        Route::get('/downloadSertif/{id}', [SertifikasiControllerSiswa::class, 'downloadSertif'])->name('siswa.downloadRapor');
    });
});