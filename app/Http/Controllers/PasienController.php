<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'resepsionis') {
            abort(403, 'Akses ditolak');
        }

        $pasien = Pasien::all();
        return view('resepsionis.pasien', compact('pasien'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required',
            'jns_kelamin' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        Pasien::create($request->all());
        return redirect('/pasien')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama_pasien' => 'required',
            'jns_kelamin' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        $pasien->update($request->all());
        return redirect('/pasien')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return redirect('/pasien')->with('success', 'Data berhasil dihapus!');
    }
}
