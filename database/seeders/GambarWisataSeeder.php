<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GambarWisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get tempat_wisata IDs
        $tumpakSewu = DB::table('tempat_wisata')->where('nama', 'Air Terjun Tumpak Sewu')->first()->id;
        $semeru = DB::table('tempat_wisata')->where('nama', 'Gunung Semeru')->first()->id;
        $pantaiBambang = DB::table('tempat_wisata')->where('nama', 'Pantai Bambang')->first()->id;
        $kapasBiru = DB::table('tempat_wisata')->where('nama', 'Air Terjun Kapas Biru')->first()->id;
        $b29 = DB::table('tempat_wisata')->where('nama', 'B29 Argosari')->first()->id;

        $gambarWisata = [
            // Tumpak Sewu Images
            [
                'wisata_id' => $tumpakSewu,
                'path_gambar' => 'tumpak-sewu.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wisata_id' => $tumpakSewu,
                'path_gambar' => 'tumpak-sewu-1.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Semeru Images
            [
                'wisata_id' => $semeru,
                'path_gambar' => 'semeru.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wisata_id' => $semeru,
                'path_gambar' => 'semeru-1.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Pantai Bambang Images
            [
                'wisata_id' => $pantaiBambang,
                'path_gambar' => 'bambang.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wisata_id' => $pantaiBambang,
                'path_gambar' => 'bambang-1.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kapas Biru Images
            [
                'wisata_id' => $kapasBiru,
                'path_gambar' => 'kapas-biru.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wisata_id' => $kapasBiru,
                'path_gambar' => 'kapas-biru-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // B29 Images
            [
                'wisata_id' => $b29,
                'path_gambar' => 'b29.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wisata_id' => $b29,
                'path_gambar' => 'b29-1.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('gambar_wisata')->insert($gambarWisata);
    }
}
