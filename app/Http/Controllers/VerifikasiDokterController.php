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
            $dokter = Dokter::where('email', $email)->get();
        } else {
            $dokter = [];
        }

        return view('dokter', compact('dokter'));
    }

    public function verifikasiEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $dokter = Dokter::where('email', $request->email)->first();

        if ($dokter) {
            Session::put('verified_email', $request->email);
            return redirect()->route('dokter.index');
        } else {
            return back()->with('error', 'Email tidak ditemukan di data dokter.');
        }
    }

    public function logoutVerifikasi()
    {
        Session::forget('verified_email');
        return redirect()->route('dokter.index');
    }
}
