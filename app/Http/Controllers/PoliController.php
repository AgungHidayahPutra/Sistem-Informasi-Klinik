<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $poli = Poli::all();
        return view('poli', compact('poli'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required',
        ]);

        Poli::create($request->all());
        return redirect('/poli')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, Poli $poli)
    {
        $request->validate([
            'nama_poli' => 'required',
        ]);

        $poli->update($request->all());
        return redirect('/poli')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Poli $poli)
    {
        $poli->delete();
        return redirect('/poli')->with('success', 'Data berhasil dihapus!');
    }
}
