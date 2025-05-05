<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerifikasiDokterController extends Controller
{
    public function index(Request $request)
    {
        $email = Session::get('verified_email');

        if ($email) {
            $dokter = Dokter::where('email', $email)->first(); // Ambil satu data dokter
            return view('dokter.data-dokter', compact('dokter'));
        } else {
            return view('dokter.data-dokter');
        }        
    }

    public function verifikasiEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $dokters = Dokter::where('email', $request->email)->first();

        if ($dokters) {
            Session::put('verified_email', $request->email);
            return redirect()->route('verifikasi-dokter.index');
        } else {
            return back()->with('error', 'Email tidak ditemukan di data dokter.');
        }
    }

    public function logoutVerifikasi()
    {
        Session::forget('verified_email');
        return redirect()->route('verifikasi-dokter.index');
    }
}
