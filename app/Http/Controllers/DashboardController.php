<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Antrian;
use App\Models\Dokter;

class DashboardController extends Controller
{


    public function index()
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return view('admin.dashboard');

            case 'dokter':
                return view('dokter.dashboard');

            case 'resepsionis':
                $jumlahMenunggu = Antrian::where('status', 'Menunggu')->count();
                $jumlahSedangDiperiksa = Antrian::where('status', 'Sedang diperiksa')->count();
                $jumlahTersedia = Dokter::where('sts_dokter', 'Tersedia')->count();

                return view('resepsionis.dashboard', compact(
                    'jumlahMenunggu',
                    'jumlahSedangDiperiksa',
                    'jumlahTersedia'
                ));

            default:
                abort(403, 'Akses ditolak');
        }
    }
}
