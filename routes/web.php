<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('pasien', PasienController::class);
    Route::resource('poli', PoliController::class);
    Route::resource('dokter', DokterController::class)->except(['show']);
    Route::resource('antrian', AntrianController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('rekam-medis', RekamMedisController::class);
    Route::resource('user', UserController::class);

    // Autocomplete routes
    Route::get('/autocompleteantrian/pasien', [AntrianController::class, 'autocompletePasien']);
    Route::get('/autocompleteantrian/poli', [AntrianController::class, 'autocompletePoli']);
    Route::get('/autocompleteantrian/dokter', [AntrianController::class, 'autocompleteDokter']);

    Route::get('/autocompletepembayaran/pasien', [PembayaranController::class, 'autocompletePasien']);
    Route::get('/autocompletepembayaran/dokter', [PembayaranController::class, 'autocompleteDokter']);

    Route::get('/autocompletejadwal/dokter', [JadwalController::class, 'autocompleteDokter']);

    Route::get('/autocompleterekammedis/pasien', [RekamMedisController::class, 'autocompletePasien']);
    Route::get('/autocompleterekammedis/poli', [RekamMedisController::class, 'autocompletePoli']);
    Route::get('/autocompleterekammedis/dokter', [RekamMedisController::class, 'autocompleteDokter']);
});

Route::prefix('halaman-dokter')->middleware(['auth'])->group(function () {
    Route::get('/', [DokterController::class, 'halamanDokter'])->name('dokter.halaman');
    Route::post('/verifikasi', [DokterController::class, 'verifikasiEmail'])->name('dokter.verifikasi');
});
