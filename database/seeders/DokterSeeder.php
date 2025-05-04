<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dokter;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        Dokter::create([
            'nama_dokter' => 'dr. Andi',
            'spesialis' => 'Umum',
            'no_hp' => '081234567890',
            'email' => 'Andi@gmail.com',
            'sts_dokter' => 'tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Dokter::create([
            'nama_dokter' => 'dr. Budi',
            'spesialis' => 'Anak',
            'no_hp' => '081298765432',
            'email' => 'Budi@gmail.com',
            'sts_dokter' => 'tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Dokter::create([
            'nama_dokter' => 'dr. Citra',
            'spesialis' => 'Gigi',
            'no_hp' => '082112223333',
            'email' => 'Citra@gmail.com',
            'sts_dokter' => 'tidak tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
