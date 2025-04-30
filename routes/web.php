<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\DokterController;

Route::resource('pasien', PasienController::class);
Route::resource('poli', PoliController::class);
Route::resource('dokter', DokterController::class);

Route::get('/', function () {
    return view('dashboard');
});


Route::get('/antrian', function () {
    return view('antrian');
});

Route::get('/jadwal', function () {
    return view('jadwal');
});

Route::get('/pembayaran', function () {
    return view('pembayaran');
});

Route::get('/rekam-medis', function () {
    return view('rekam-medis');
});
