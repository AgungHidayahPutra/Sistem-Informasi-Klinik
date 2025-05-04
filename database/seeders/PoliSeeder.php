<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('poli')->insert([
            [
                'nama_poli' => 'Umum',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_poli' => 'Gigi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_poli' => 'Anak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
