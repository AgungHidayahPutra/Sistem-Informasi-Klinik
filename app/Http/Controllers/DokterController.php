<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        $email = Session::get('verified_email');

        if ($email) {
            $dokter = Dokter::where('email', $email)->get();
        } else {
            $dokter = []; // Kosong jika belum verifikasi
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

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required',
            'spesialis' => 'required',
            'sts_dokter' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email|unique:dokter,email',
        ]);

        Dokter::create($request->all());
        return redirect('/dokter')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama_dokter' => 'required',
            'spesialis' => 'required',
            'sts_dokter' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email|unique:dokter,email,' . $dokter->id,
        ]);

        $dokter->update($request->all());
        return redirect('/dokter')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return redirect('/dokter')->with('success', 'Data berhasil dihapus!');
    }

    public function logoutVerifikasi()
    {
        Session::forget('verified_email');
        return redirect()->route('dokter.index');
    }
}
