<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        $role = Auth::user()->role;

        if (!in_array($role, ['admin', 'resepsionis', 'dokter'])) {
            abort(403, 'Akses ditolak');
        }

        $dokters = Dokter::all();

        if ($role === 'admin') {
            return view('admin.dokter', compact('dokters'));
        } else {
            return view('resepsionis.dokter', compact('dokters'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required',
            'spesialis' => 'required',
            'sts_dokter' => 'Tidak Tersedia',
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

        if (Auth::user()->role === 'dokter') {
            session(['dokterData' => $dokter]); // Update data session
            return redirect()->route('dokter.halaman')->with('success', 'Data berhasil diperbarui!');
        } else {
            return redirect('/dokter')->with('success', 'Data berhasil diperbarui!');
        }
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return redirect('/dokter')->with('success', 'Data berhasil dihapus!');
    }

    // Menampilkan form verifikasi email
    public function halamanDokter()
    {
        $role = Auth::user()->role;

        if ($role !== 'dokter') {
            abort(403, 'Akses ditolak');
        }

        $dokterData = session('dokterData');

        return view('dokter.dokter', compact('dokterData'));
    }

    // Verifikasi email dan tampilkan data dokter yang cocok
    public function verifikasiEmail(Request $request)
    {
        $role = Auth::user()->role;

        if ($role !== 'dokter') {
            abort(403, 'Akses ditolak');
        }

        $request->validate([
            'email' => 'required|email'
        ]);

        $dokter = Dokter::where('email', $request->email)->first();

        if (!$dokter) {
            return redirect()->route('dokter.halaman')->with('error', 'Email tidak ditemukan!');
        }

        // Simpan data ke session
        session(['dokterData' => $dokter]);

        return redirect()->route('dokter.halaman');
    }
}
