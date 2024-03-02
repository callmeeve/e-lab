<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\kategori;
class kategoriSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        kategori::create(['nama_kategori' => 'Elektronik']);
        kategori::create(['nama_kategori' => 'Peralatan Rumah Tangga']);
        kategori::create(['nama_kategori' => 'Pakaian']);
    }
}
