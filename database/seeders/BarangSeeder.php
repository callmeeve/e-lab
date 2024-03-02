<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BarangLab;
class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BarangLab::create([
            'nama_barang' => 'Laptop',
            'image' => 'path_to_image/laptop.jpg', // Ganti dengan path gambar sesuai kebutuhan
            'stok' => 10,
            'id_kategori' => 1, // ID kategori Elektronik
        ]);

        BarangLab::create([
            'nama_barang' => 'Panci',
            'image' => 'path_to_image/panci.jpg', // Ganti dengan path gambar sesuai kebutuhan
            'stok' => 20,
            'id_kategori' => 2, // ID kategori Peralatan Rumah Tangga
        ]);
    }
}
