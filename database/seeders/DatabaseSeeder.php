<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PoliSeeder::class,
            DokterSeeder::class,
            PasienSeeder::class,
            RmeSeeder::class,
            AntrianSeeder::class,
            PembayaranSeeder::class,
            UserSeeder::class,
        ]);
    }
}
