<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriWisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['nama_kategori' => 'Air Terjun'],
            ['nama_kategori' => 'Gunung'],
            ['nama_kategori' => 'Pantai'],
            ['nama_kategori' => 'Taman'],
            ['nama_kategori' => 'Wisata Alam'],
            ['nama_kategori' => 'Wisata Religi'],
            ['nama_kategori' => 'Wisata Sejarah'],
            ['nama_kategori' => 'Wisata Kuliner'],
        ];

        DB::table('kategori_wisata')->insert($categories);
    }
}
