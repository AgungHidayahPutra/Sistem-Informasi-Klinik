<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        $pasien = Pasien::pluck('id')->toArray();
        $dokter = Dokter::pluck('id')->toArray();

        $layanan = [
            'Pemeriksaan',
            'Kontrol',
            'Rawat Jalan'
        ];

        $metode = [
            'Cash',
            'QRIS',
            'Transfer'
        ];

        for ($i = 1; $i <= 500; $i++) {

            $tanggal = Carbon::now()
                ->subDays(rand(0, 180))
                ->setTime(rand(8, 16), rand(0, 59));

            Pembayaran::create([
                'pasien_id' => $pasien[array_rand($pasien)],
                'dokter_id' => $dokter[array_rand($dokter)],
                'tgl_pembayaran' => $tanggal,
                'nominal' => rand(50000, 250000),
                'layanan' => $layanan[array_rand($layanan)],
                'jns_pembayaran' => $metode[array_rand($metode)],
                'created_at' => $tanggal,
                'updated_at' => $tanggal
            ]);
        }
    }
}
