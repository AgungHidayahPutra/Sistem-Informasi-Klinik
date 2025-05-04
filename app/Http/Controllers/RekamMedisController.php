<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index()
    {
        $datarekammedis = RekamMedis::with(['pasien', 'dokter', 'poli'])->get();
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        $polis = Poli::all();

        return view('rekam-medis', compact('datarekammedis', 'pasiens', 'dokters', 'polis'));
    }

    public function store(Request $request)
    {
        $namaPasien = $request->input('nama_pasien');
        $namaPoli = $request->input('nama_poli');
        $namaDokter = $request->input('nama_dokter');

        $pasien = Pasien::where('nama_pasien', $namaPasien)->first();
        $poli = Poli::where('nama_poli', $namaPoli)->first();
        $dokter = Dokter::where('nama_dokter', $namaDokter)->first();

        if (!$pasien || !$poli || !$dokter) {
            $pesan = '';
            if (!$pasien) $pesan .= 'Data pasien tidak ditemukan! ';
            if (!$poli) $pesan .= 'Data poli tidak ditemukan! ';
            if (!$dokter) $pesan .= 'Data dokter tidak ditemukan! ';

            return redirect()->back()->with('error', $pesan);
        }

        RekamMedis::create([
            'pasien_id' => $pasien->id,
            'poli_id' => $poli->id,
            'dokter_id' => $dokter->id,
            'keluhan' => $request->input('keluhan'),
            'resep_obat' => $request->input('resep_obat'),
            'penyakit' => $request->input('penyakit'),
            'tgl_daftar' => now()
        ]);

        return redirect()->back()->with('success', 'Rekam medis berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'poli_id'   => 'required|exists:poli,id',
            'keluhan' => 'required|string',
            'resep_obat' => 'required|string',
            'penyakit' => 'required|string',
        ]);

        $rekam = RekamMedis::findOrFail($id);
        $rekam->update([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'poli_id'   => $request->poli_id,
            'keluhan' => $request->keluhan,
            'resep_obat' => $request->resep_obat,
            'penyakit' => $request->penyakit
        ]);

        return redirect()->route('rekam-medis.index')->with('success', 'Data rekam medis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rekam = RekamMedis::findOrFail($id);
        $rekam->delete();

        return redirect()->route('rekam-medis.index')->with('success', 'Data rekam medis berhasil dihapus.');
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
