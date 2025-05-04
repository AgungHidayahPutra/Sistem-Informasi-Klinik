<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pasien')->insert([
            [
                'nama_pasien' => 'Ahmad Fauzi',
                'jns_kelamin' => 'Laki-laki',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 10, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Siti Nurhaliza',
                'jns_kelamin' => 'Perempuan',
                'no_hp' => '082345678901',
                'alamat' => 'Jl. Veteran No. 5, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Budi Santoso',
                'jns_kelamin' => 'Laki-laki',
                'no_hp' => '083456789012',
                'alamat' => 'Jl. Sudirman No. 20, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
