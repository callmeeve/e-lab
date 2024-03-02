<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Data pengguna
        $users = [
            [
                'username' => 'widi',
                'email' => 'widi@example.com',
                'password' => Hash::make('password'),
                'role' => 'dosen', // Sesuaikan dengan peran yang sesuai
            ],
            [
                'username' => 'haris',
                'email' => 'haris@example.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa', // Sesuaikan dengan peran yang sesuai
            ],
            [
                'username' => 'teknisi',
                'email' => 'teknisi@example.com',
                'password' => Hash::make('password'),
                'role' => 'teknisi_lab', // Sesuaikan dengan peran yang sesuai
            ],
            [
                'username' => 'kepala',
                'email' => 'kepala@example.com',
                'password' => Hash::make('password'),
                'role' => 'kepala_lab', // Sesuaikan dengan peran yang sesuai
            ],

            // Tambahkan data pengguna lain jika diperlukan
        ];

        // Memasukkan data ke dalam tabel
        DB::table('user')->insert($users);
    }
}
