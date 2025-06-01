<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TempatWisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin_wisata ID
        $adminId = DB::table('users')
            ->where('role', 'adminwisata')
            ->first()->id;

        // Get kategori IDs
        $kategoriAirTerjun = DB::table('kategori_wisata')->where('nama_kategori', 'Air Terjun')->first()->id;
        $kategoriGunung = DB::table('kategori_wisata')->where('nama_kategori', 'Gunung')->first()->id;
        $kategoriPantai = DB::table('kategori_wisata')->where('nama_kategori', 'Pantai')->first()->id;
        $kategoriWisataAlam = DB::table('kategori_wisata')->where('nama_kategori', 'Wisata Alam')->first()->id;

        $tempatWisata = [
            [
                'nama' => 'Air Terjun Tumpak Sewu',
                'deskripsi' => 'Air terjun dengan ketinggian 120 meter yang memiliki aliran air berbentuk tirai. Salah satu air terjun terindah di Indonesia dengan pemandangan yang memukau dan suasana yang sejuk. Cocok untuk pecinta fotografi dan penggemar wisata alam.',
                'lokasi' => 'Desa Sidomulyo, Kecamatan Pronojiwo, Kabupaten Lumajang, Jawa Timur',
                'link_maps' => 'https://goo.gl/maps/B7LZwTqYRnUmgV8d6',
                'jam_operasional' => '07:00 - 16:00',
                'harga_tiket' => 10000.00,
                'admin_id' => $adminId,
                'kategori_id' => $kategoriAirTerjun,
            ],
            [
                'nama' => 'Gunung Semeru',
                'deskripsi' => 'Gunung tertinggi di Pulau Jawa dengan ketinggian 3.676 mdpl. Destinasi favorit para pendaki dengan pemandangan matahari terbit yang menakjubkan dari Puncak Mahameru. Terdapat Ranu Kumbolo dan Ranu Pani sebagai tempat berkemah.',
                'lokasi' => 'Taman Nasional Bromo Tengger Semeru, Kabupaten Lumajang, Jawa Timur',
                'link_maps' => 'https://goo.gl/maps/wK9nL8Rj7HvY3LUNA',
                'jam_operasional' => '24 Jam (Sesuai Izin Pendakian)',
                'harga_tiket' => 15000.00,
                'admin_id' => $adminId,
                'kategori_id' => $kategoriGunung,
            ],
            [
                'nama' => 'Pantai Bambang',
                'deskripsi' => 'Pantai dengan pasir hitam dan ombak yang cocok untuk berselancar. Memiliki pemandangan sunset yang indah dan area camping yang luas. Terdapat banyak warung yang menjual seafood segar.',
                'lokasi' => 'Desa Bades, Kecamatan Pasirian, Kabupaten Lumajang, Jawa Timur',
                'link_maps' => 'https://goo.gl/maps/XQ8YKqL9TZ2Nf6YS7',
                'jam_operasional' => '06:00 - 17:00',
                'harga_tiket' => 5000.00,
                'admin_id' => $adminId,
                'kategori_id' => $kategoriPantai,
            ],
            [
                'nama' => 'Air Terjun Kapas Biru',
                'deskripsi' => 'Air terjun dengan aliran air yang menyerupai kapas putih yang lembut. Memiliki kolam alami yang jernih dan area piknik yang nyaman. Akses mudah dan cocok untuk wisata keluarga.',
                'lokasi' => 'Desa Pronojiwo, Kecamatan Pronojiwo, Kabupaten Lumajang, Jawa Timur',
                'link_maps' => 'https://goo.gl/maps/7Z8q4Z9QZ4Z4Z4Z4A',
                'jam_operasional' => '07:00 - 16:00',
                'harga_tiket' => 10000.00,
                'admin_id' => $adminId,
                'kategori_id' => $kategoriAirTerjun,
            ],
            [
                'nama' => 'B29 Argosari',
                'deskripsi' => 'Negeri di atas awan dengan pemandangan matahari terbit yang spektakuler. Spot camping dan fotografi yang populer dengan latar belakang Gunung Semeru. Dapat ditempuh dengan kendaraan roda dua atau empat.',
                'lokasi' => 'Desa Argosari, Kecamatan Senduro, Kabupaten Lumajang, Jawa Timur',
                'link_maps' => 'https://goo.gl/maps/qL8YKqL9TZ2Nf6YS7',
                'jam_operasional' => '24 Jam',
                'harga_tiket' => 5000.00,
                'admin_id' => $adminId,
                'kategori_id' => $kategoriWisataAlam,
            ],
        ];

        DB::table('tempat_wisata')->insert($tempatWisata);
    }
}
