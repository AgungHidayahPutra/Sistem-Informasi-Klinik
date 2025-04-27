<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dokter', function () {
    return view('dokter');
});

Route::get('/antrian', function () {
    return view('antrian');
});

Route::get('/jadwal', function () {
    return view('jadwal');
});

Route::get('/pasien', function () {
    return view('pasien');
});

Route::get('/pembayaran', function () {
    return view('pembayaran');
});

Route::get('/rekam-medis', function () {
    return view('rekam-medis');
});
