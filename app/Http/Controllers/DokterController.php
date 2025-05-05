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
    } elseif ($role === 'dokter') {
        return view('dokter.data-dokter', compact('dokters'));
    } else {
        return view('resepsionis.dokter', compact('dokters'));
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

}
