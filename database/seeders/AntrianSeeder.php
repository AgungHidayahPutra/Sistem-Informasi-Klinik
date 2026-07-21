<?php

namespace Database\Seeders;

use App\Models\Antrian;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AntrianSeeder extends Seeder
{
    public function run(): void
    {
        $pasien = Pasien::pluck('id')->toArray();
        $dokter = Dokter::pluck('id')->toArray();
        $poli = Poli::pluck('id')->toArray();

        $status = [
            'Menunggu',
            'Sedang diperiksa',
            'Selesai'
        ];

        for ($i = 1; $i <= 500; $i++) {

            $tanggal = Carbon::now()
                ->subDays(rand(0, 180))
                ->setTime(rand(8, 16), rand(0, 59));

            Antrian::create([
                'pasien_id' => $pasien[array_rand($pasien)],
                'dokter_id' => $dokter[array_rand($dokter)],
                'poli_id' => $poli[array_rand($poli)],
                'status' => $status[array_rand($status)],
                'created_at' => $tanggal,
                'updated_at' => $tanggal
            ]);
        }
    }
}
