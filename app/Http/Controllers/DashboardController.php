<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Antrian;
use App\Models\Dokter;

class DashboardController extends Controller
{

    public function index()
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'resepsionis':
                $jumlahMenunggu = Antrian::where('status', 'Menunggu')->count();
                $jumlahSedangDiperiksa = Antrian::where('status', 'Sedang diperiksa')->count();
                $jumlahTersedia = Dokter::where('sts_dokter', 'Tersedia')->count();

                // Pie chart data
                $data = DB::table('rme')
                    ->join('poli', 'rme.poli_id', '=', 'poli.id')
                    ->select('poli.nama_poli', DB::raw('COUNT(rme.id) as total'))
                    ->groupBy('poli.nama_poli')
                    ->get();
                $labels = $data->pluck('nama_poli');
                $counts = $data->pluck('total');

                // Bar chart data
                $rmePerMonth = DB::table('rme')
                    ->select(
                        DB::raw("MONTH(tgl_daftar) as bulan_num"),
                        DB::raw("MONTHNAME(tgl_daftar) as bulan"),
                        DB::raw("COUNT(*) as total")
                    )
                    ->groupBy(DB::raw("MONTH(tgl_daftar), MONTHNAME(tgl_daftar)"))
                    ->orderBy(DB::raw("MONTH(tgl_daftar)"))
                    ->get();
                $bulanLabels = $rmePerMonth->pluck('bulan');
                $jumlahPerBulan = $rmePerMonth->pluck('total');

                return view('resepsionis.dashboard', compact(
                    'jumlahMenunggu',
                    'jumlahSedangDiperiksa',
                    'jumlahTersedia',
                    'labels',
                    'counts',
                    'bulanLabels',
                    'jumlahPerBulan'
                ));

            default:
                abort(403, 'Akses ditolak');
        }
    }
}
