<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;



// guru
// use App\Http\Controllers\Guru\PenilaianKegiatanGuruController;
// use App\Http\Controllers\Guru\PenilaianRaporGuruController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Import routes siswa dan guru
require base_path('routes/admin.php');
require base_path('routes/guru.php');

Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->name('login')->middleware('guest');
    Route::post('cek_login', 'authenticate')->name("cek_login");
});


//Route::middleware('auth')->group(function () {

//});