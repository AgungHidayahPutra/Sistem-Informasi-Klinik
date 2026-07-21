<?php

namespace Database\Seeders;

use App\Models\RekamMedis;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RmeSeeder extends Seeder
{
    public function run(): void
    {
        $keluhan = [
            'Demam',
            'Batuk',
            'Pilek',
            'Pusing',
            'Sakit Perut',
            'Nyeri Sendi',
            'Sesak Napas',
            'Mual'
        ];

        $penyakit = [
            'Influenza',
            'Asam Lambung',
            'Hipertensi',
            'Diabetes',
            'ISPA',
            'Migrain',
            'Tifus'
        ];

        $obat = [
            'Paracetamol',
            'Amoxicillin',
            'Vitamin C',
            'Antasida',
            'Omeprazole',
            'Ibuprofen'
        ];

        $pasien = Pasien::pluck('id')->toArray();
        $dokter = Dokter::pluck('id')->toArray();
        $poli = Poli::pluck('id')->toArray();

        for ($i = 1; $i <= 500; $i++) {

            $tanggal = Carbon::now()
                ->subDays(rand(0, 180))
                ->setTime(rand(8, 16), rand(0, 59));

            RekamMedis::create([
                'pasien_id' => $pasien[array_rand($pasien)],
                'dokter_id' => $dokter[array_rand($dokter)],
                'poli_id' => $poli[array_rand($poli)],
                'keluhan' => $keluhan[array_rand($keluhan)],
                'resep_obat' => $obat[array_rand($obat)],
                'penyakit' => $penyakit[array_rand($penyakit)],
                'tgl_daftar' => $tanggal,
                'created_at' => $tanggal,
                'updated_at' => $tanggal,
            ]);
        }
    }
}
