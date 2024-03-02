<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TeknisiLab;
class TeknisiLabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TeknisiLab::create(['nama_teknisi' => 'fiki', 'user_id' => '3']);
    }
}
