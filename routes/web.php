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


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('pasien', PasienController::class);
Route::resource('poli', PoliController::class);
Route::resource('dokter', DokterController::class)->except(['show']);
Route::resource('antrian', AntrianController::class);
Route::resource('pembayaran', PembayaranController::class);
Route::resource('jadwal', JadwalController::class);
Route::resource('rekam-medis', RekamMedisController::class);


// Route tambahan untuk verifikasi email sebelum akses data dokter
Route::post('/dokter/verifikasi', [DokterController::class, 'verifikasiEmail'])->name('dokter.verifikasi');

// Route untuk menghapus sesi verifikasi email
Route::get('/dokter/logoutverifikasi', [DokterController::class, 'logoutVerifikasi'])->name('dokter.logoutverifikasi');

Route::get('/autocomplete/pasien', [AntrianController::class, 'autocompletePasien']);
Route::get('/autocomplete/poli', [AntrianController::class, 'autocompletePoli']);
Route::get('/autocomplete/dokter', [AntrianController::class, 'autocompleteDokter']);

Route::get('/autocomplete/pasien', [PembayaranController::class, 'autocompletePasien']);
Route::get('/autocomplete/dokter', [PembayaranController::class, 'autocompleteDokter']);

Route::get('/autocomplete/dokter', [JadwalController::class, 'autocompleteDokter']);

Route::get('/autocomplete/pasien', [RekamMedisController::class, 'autocompletePasien']);
Route::get('/autocomplete/poli', [RekamMedisController::class, 'autocompletePoli']);
Route::get('/autocomplete/dokter', [RekamMedisController::class, 'autocompleteDokter']);