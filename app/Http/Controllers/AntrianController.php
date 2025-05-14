<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AntrianController extends Controller
{
    public function index()
    {

        $role = Auth::user()->role;

        if (!in_array($role, ['dokter', 'resepsionis'])) {
            abort(403, 'Akses ditolak');
        }

        $antrians = Antrian::with(['pasien', 'dokter', 'poli'])->get();
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        $polis = Poli::all();
        $statuses = ['Menunggu', 'Sedang diperiksa', 'Selesai'];

        if ($role === 'dokter') {
            return view('dokter.antrian', compact('antrians', 'pasiens', 'dokters', 'polis', 'statuses'));
        } else {
            return view('resepsionis.antrian', compact('antrians', 'pasiens', 'dokters', 'polis', 'statuses'));
        }
    }

    public function store(Request $request)
    {
        // Ambil data dari form
        $namaPasien = $request->input('nama_pasien');
        $namaPoli = $request->input('nama_poli');
        $namaDokter = $request->input('nama_dokter');
    
        // Cek apakah data ada di database
        $pasien = Pasien::where('nama_pasien', $namaPasien)->first();
        $poli = Poli::where('nama_poli', $namaPoli)->first();
        $dokter = Dokter::where('nama_dokter', $namaDokter)->first();
    
        // Jika salah satu tidak ditemukan, kirim notifikasi
        if (!$pasien || !$poli || !$dokter) {
            $pesan = '';
            if (!$pasien) $pesan .= 'Data pasien tidak ditemukan! ';
            if (!$poli) $pesan .= 'Data poli tidak ditemukan! ';
            if (!$dokter) $pesan .= 'Data dokter tidak ditemukan! ';
    
            return redirect()->back()->with('error', $pesan);
        }
    
        // Jika semua valid, lanjutkan menyimpan data antrian
        Antrian::create([
            'pasien_id' => $pasien->id,
            'poli_id' => $poli->id,
            'dokter_id' => $dokter->id,
            'status' => 'Menunggu',
        ]);
    
        return redirect()->back()->with('success', 'Antrian berhasil ditambahkan.');
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'poli_id'   => 'required|exists:poli,id',
            'status'    => 'required|in:Menunggu,Sedang diperiksa,Selesai',
        ]);

        $antrian = Antrian::findOrFail($id);
        $antrian->update([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'poli_id'   => $request->poli_id,
            'status'    => $request->status,
        ]);

        return redirect()->route('antrian.index')->with('success', 'Data antrian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $antrian = Antrian::findOrFail($id);
        $antrian->delete();

        return redirect()->route('antrian.index')->with('success', 'Data antrian berhasil dihapus.');
    }
    
    public function autocompletePasien(Request $request)
    {
        $term = $request->get('term');
        $data = Pasien::where('nama_pasien', 'like', '%' . $term . '%')->get();

        return response()->json($data->map(function ($item) {
            return [
                'id' => $item->id,
                'label' => $item->nama_pasien
            ];
        }));
    }

    public function autocompletePoli(Request $request)
    {
        $term = $request->get('term');
        $data = Poli::where('nama_poli', 'like', '%' . $term . '%')->get();

        return response()->json($data->map(function ($item) {
            return [
                'id' => $item->id,
                'label' => $item->nama_poli
            ];
        }));
    }

    public function autocompleteDokter(Request $request)
    {
        $term = $request->get('term');
        $data = Dokter::where('nama_dokter', 'like', '%' . $term . '%')->get();

        return response()->json($data->map(function ($item) {
            return [
                'id' => $item->id,
                'label' => $item->nama_dokter
            ];
        }));
    }
    
}
