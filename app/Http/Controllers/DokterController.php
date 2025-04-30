<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::all();
        return view('dokter', compact('dokter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required',
            'spesialis' => 'required',
            'sts_dokter' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
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
            'email' => 'required',
        ]);

        $dokter->update($request->all());
        return redirect('/dokter')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return redirect('/dokter')->with('success', 'Data berhasil dihapus!');
    }
}
