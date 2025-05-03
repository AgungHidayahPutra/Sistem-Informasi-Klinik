<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with(['pasien', 'dokter'])->get();
        $pasiens = Pasien::all();
        $dokters = Dokter::all();

        return view('pembayaran', compact('pembayarans', 'pasiens', 'dokters'));
    }

    public function store(Request $request)
    {
        // Ambil data dari form
        $namaPasien = $request->input('nama_pasien');
        $namaDokter = $request->input('nama_dokter');

        // Cari data di database
        $pasien = Pasien::where('nama_pasien', $namaPasien)->first();
        $dokter = Dokter::where('nama_dokter', $namaDokter)->first();

        // Validasi apakah data ditemukan
        if (!$pasien || !$dokter) {
            $pesan = '';
            if (!$pasien) $pesan .= 'Data pasien tidak ditemukan! ';
            if (!$dokter) $pesan .= 'Data dokter tidak ditemukan! ';

            return redirect()->back()->with('error', $pesan);
        }

        // Simpan data pembayaran
        Pembayaran::create([
            'pasien_id' => $pasien->id,
            'dokter_id' => $dokter->id,
            'tgl_pembayaran' => now(),
            'nominal' => $request->input('nominal'),
            'layanan' => $request->input('layanan'),
            'jns_pembayaran' => $request->input('jns_pembayaran'),
        ]);

        return redirect()->back()->with('success', 'Data pembayaran berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'nominal' => 'required|integer',
            'layanan' => 'required|string',
            'jns_pembayaran' => 'required|string',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'nominal' => $request->nominal,
            'layanan' => $request->layanan,
            'jns_pembayaran' => $request->jns_pembayaran,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus.');
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
