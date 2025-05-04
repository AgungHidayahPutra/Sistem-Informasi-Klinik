<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            [
                'nama_pasien' => 'Dewi Lestari',
                'jns_kelamin' => 'Perempuan',
                'no_hp' => '084567890123',
                'alamat' => 'Jl. Pahlawan No. 12, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Rizky Maulana',
                'jns_kelamin' => 'Laki-laki',
                'no_hp' => '085678901234',
                'alamat' => 'Jl. Rajawali No. 7, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Nur Aini',
                'jns_kelamin' => 'Perempuan',
                'no_hp' => '086789012345',
                'alamat' => 'Jl. Srijaya No. 3, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Tono Prasetya',
                'jns_kelamin' => 'Laki-laki',
                'no_hp' => '087890123456',
                'alamat' => 'Jl. Demang Lebar Daun No. 15, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Melati Anggraini',
                'jns_kelamin' => 'Perempuan',
                'no_hp' => '088901234567',
                'alamat' => 'Jl. Angkatan 45 No. 8, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Hendra Wijaya',
                'jns_kelamin' => 'Laki-laki',
                'no_hp' => '089012345678',
                'alamat' => 'Jl. Kolonel H. Burlian No. 21, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Rina Amelia',
                'jns_kelamin' => 'Perempuan',
                'no_hp' => '081122334455',
                'alamat' => 'Jl. Basuki Rahmat No. 19, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Fadli Rahman',
                'jns_kelamin' => 'Laki-laki',
                'no_hp' => '082233445566',
                'alamat' => 'Jl. Letkol Iskandar No. 4, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Lilis Karlina',
                'jns_kelamin' => 'Perempuan',
                'no_hp' => '083344556677',
                'alamat' => 'Jl. Kapten A. Rivai No. 17, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Yusuf Hamzah',
                'jns_kelamin' => 'Laki-laki',
                'no_hp' => '084455667788',
                'alamat' => 'Jl. R. Sukamto No. 6, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Fitri Handayani',
                'jns_kelamin' => 'Perempuan',
                'no_hp' => '085566778899',
                'alamat' => 'Jl. Sako Baru No. 11, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Imran Hakim',
                'jns_kelamin' => 'Laki-laki',
                'no_hp' => '086677889900',
                'alamat' => 'Jl. A. Yani No. 30, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Yulia Kartika',
                'jns_kelamin' => 'Perempuan',
                'no_hp' => '087788990011',
                'alamat' => 'Jl. Sumpah Pemuda No. 27, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Dedi Kurniawan',
                'jns_kelamin' => 'Laki-laki',
                'no_hp' => '088899001122',
                'alamat' => 'Jl. Mangkunegara No. 9, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Sri Rahayu',
                'jns_kelamin' => 'Perempuan',
                'no_hp' => '089900112233',
                'alamat' => 'Jl. Kenten Laut No. 6, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Rian Pratama',
                'jns_kelamin' => 'Laki-laki',
                'no_hp' => '081133244355',
                'alamat' => 'Jl. Mayor Ruslan No. 23, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pasien' => 'Indah Wulandari',
                'jns_kelamin' => 'Perempuan',
                'no_hp' => '082144355466',
                'alamat' => 'Jl. Sukabangun No. 10, Palembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
