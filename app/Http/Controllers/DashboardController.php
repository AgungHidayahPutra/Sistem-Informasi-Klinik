<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

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
                return view('resepsionis.dashboard');
            default:
                abort(403, 'Akses ditolak');
        }
    }
}
