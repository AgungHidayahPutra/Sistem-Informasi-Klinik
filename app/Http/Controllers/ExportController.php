<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Antrian;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\Pembayaran;

class ExportController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }

        return view('admin.export');
    }

    public function dataAntrian()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }

        $antrians = Antrian::with(['pasien', 'dokter', 'poli'])->get();

        return view('admin.export.data-antrian', compact('antrians'));
    }

    public function dataPasien()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }

        $pasiens = Pasien::all();

        return view('admin.export.data-pasien', compact('pasiens'));
    }

    public function dataRekamMedis()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }

        $datarekammedis = RekamMedis::with(['pasien', 'dokter', 'poli'])->get();
        
        return view('admin.export.data-rekam-medis', compact('datarekammedis'));
    }

    public function dataPembayaran()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }

        $pembayarans = Pembayaran::with(['pasien', 'dokter'])->get();

        return view('admin.export.data-pembayaran', compact('pembayarans'));
    }
}
