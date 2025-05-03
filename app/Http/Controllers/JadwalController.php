<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Dokter;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with(['dokter'])->get();
        $dokters = Dokter::all();

        return view('jadwal', compact('jadwals', 'dokters'));
    }

    public function store(Request $request)
    {

        $namaDokter = $request->input('nama_dokter');

        $dokter = Dokter::where('nama_dokter', $namaDokter)->first();

        if (!$dokter) {
            $pesan = '';
            if (!$dokter) $pesan .= 'Data dokter tidak ditemukan! ';

            return redirect()->back()->with('error', $pesan);
        }

        Jadwal::create([
            'dokter_id' => $dokter->id,
            'hari' => $request->input('hari'),
            'jam' => $request->input('jam'),
        ]);

        return redirect()->back()->with('success', 'Data jadwal berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokter,id',
            'hari' => 'required|string',
            'jam' => 'required|string',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update([
            'dokter_id' => $request->dokter_id,
            'hari' => $request->hari,
            'jam' => $request->jam,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil dihapus.');
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
