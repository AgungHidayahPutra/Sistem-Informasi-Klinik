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

        Dokter::create([
            'nama_dokter' => 'dr. Dedi',
            'spesialis' => 'Umum',
            'no_hp' => '083312345678',
            'email' => 'Dedi@gmail.com',
            'sts_dokter' => 'tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Dokter::create([
            'nama_dokter' => 'dr. Eka',
            'spesialis' => 'Anak',
            'no_hp' => '084412345678',
            'email' => 'Eka@gmail.com',
            'sts_dokter' => 'tidak tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Dokter::create([
            'nama_dokter' => 'dr. Fajar',
            'spesialis' => 'Gigi',
            'no_hp' => '085512345678',
            'email' => 'Fajar@gmail.com',
            'sts_dokter' => 'tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Dokter::create([
            'nama_dokter' => 'dr. Gita',
            'spesialis' => 'Umum',
            'no_hp' => '086612345678',
            'email' => 'Gita@gmail.com',
            'sts_dokter' => 'tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Dokter::create([
            'nama_dokter' => 'dr. Hendra',
            'spesialis' => 'Umum',
            'no_hp' => '087712345678',
            'email' => 'Hendra@gmail.com',
            'sts_dokter' => 'tidak tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Dokter::create([
            'nama_dokter' => 'dr. Intan',
            'spesialis' => 'Anak',
            'no_hp' => '088812345678',
            'email' => 'Intan@gmail.com',
            'sts_dokter' => 'tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
