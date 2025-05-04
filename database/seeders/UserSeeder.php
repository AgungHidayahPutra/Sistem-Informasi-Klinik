<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(value: 'admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'Dokter',
            'email' => 'dokter@gmail.com',
            'password' => Hash::make('dokter123'),
            'role' => 'dokter',
        ]);

        User::create([
            'username' => 'Resepsionis',
            'email' => 'resepsionis@gmail.com',
            'password' => Hash::make('resepsionis123'),
            'role' => 'resepsionis',
        ]);
    }
}
