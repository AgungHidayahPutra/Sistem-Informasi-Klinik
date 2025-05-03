<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function index()
    {
        $antrians = Antrian::with(['pasien', 'dokter', 'poli'])->get();
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        $polis = Poli::all();
        $statuses = ['Menunggu', 'Sedang diperiksa', 'Selesai'];

        return view('antrian', compact('antrians', 'pasiens', 'dokters', 'polis', 'statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'poli_id'   => 'required|exists:poli,id',
            'status'    => 'required|in:Menunggu,Sedang diperiksa,Selesai',
        ]);

        Antrian::create([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'poli_id'   => $request->poli_id,
            'status'    => $request->status,
        ]);

        return redirect()->route('antrian.index')->with('success', 'Data antrian berhasil ditambahkan.');
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
