<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

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
require __DIR__.'/admin.php';
require __DIR__.'/guru.php';
require __DIR__.'/siswa.php';

Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->name('login')->middleware('guest');
    Route::post('/cek_login', 'authenticate')->name("cek_login");
    Route::get('/logout/{guard}', 'logout')->name('logout')->middleware('auth:guru,users,siswa');
    Route::get('/lupa_password', 'lupaPassword')->name("lupa_password");
    Route::get('/lupa_password/cek_akun/{id}', 'CekAkun')->name("CekAkun");
    Route::get('/lupa_password/input_data/{id}', 'lupa_passwordInput')->name("lupa_passwordInput");
    Route::post('/lupa_password/update_password', 'update_password')->name("update_password");
});


