<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AntrianController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::resource('pasien', PasienController::class);
Route::resource('poli', PoliController::class);
Route::resource('dokter', DokterController::class)->except(['show']);
Route::resource('antrian', AntrianController::class);

// Route tambahan untuk verifikasi email sebelum akses data dokter
Route::post('/dokter/verifikasi', [DokterController::class, 'verifikasiEmail'])->name('dokter.verifikasi');

// Route untuk menghapus sesi verifikasi email
Route::get('/dokter/logoutverifikasi', [DokterController::class, 'logoutVerifikasi'])->name('dokter.logoutverifikasi');

Route::get('/autocomplete/pasien', [AntrianController::class, 'autocompletePasien']);
Route::get('/autocomplete/poli', [AntrianController::class, 'autocompletePoli']);
Route::get('/autocomplete/dokter', [AntrianController::class, 'autocompleteDokter']);

Route::get('/jadwal', function () {
    return view('jadwal');
});

Route::get('/pembayaran', function () {
    return view('pembayaran');
});

Route::get('/rekam-medis', function () {
    return view('rekam-medis');
});
