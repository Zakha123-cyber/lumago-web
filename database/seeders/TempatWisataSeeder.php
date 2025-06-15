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
                'link_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.714021968153!2d112.91504437595864!3d-8.231486091801411!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd614085869da41%3A0x4a94cc5f06772982!2sTumpak%20Sewu%20Waterfall!5e0!3m2!1sen!2sid!4v1750014155688!5m2!1sen!2sid',
                'jam_operasional' => '07:00 - 16:00',
                'harga_tiket' => 10000.00,
                'admin_id' => $adminId,
                'kategori_id' => $kategoriAirTerjun,
            ],
            [
                'nama' => 'Gunung Semeru',
                'deskripsi' => 'Gunung tertinggi di Pulau Jawa dengan ketinggian 3.676 mdpl. Destinasi favorit para pendaki dengan pemandangan matahari terbit yang menakjubkan dari Puncak Mahameru. Terdapat Ranu Kumbolo dan Ranu Pani sebagai tempat berkemah.',
                'lokasi' => 'Taman Nasional Bromo Tengger Semeru, Kabupaten Lumajang, Jawa Timur',
                'link_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.8829804968263!2d112.94242467595687!3d-8.01100249201518!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd639b0d195ec6b%3A0xdf5d4f0095bbd1e3!2sBasecamp%20Semeru!5e0!3m2!1sen!2sid!4v1750014356154!5m2!1sen!2sid',
                'jam_operasional' => '24 Jam (Sesuai Izin Pendakian)',
                'harga_tiket' => 15000.00,
                'admin_id' => $adminId,
                'kategori_id' => $kategoriGunung,
            ],
            [
                'nama' => 'Pantai Bambang',
                'deskripsi' => 'Pantai dengan pasir hitam dan ombak yang cocok untuk berselancar. Memiliki pemandangan sunset yang indah dan area camping yang luas. Terdapat banyak warung yang menjual seafood segar.',
                'lokasi' => 'Desa Bades, Kecamatan Pasirian, Kabupaten Lumajang, Jawa Timur',
                'link_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.1217269484355!2d113.10829717595914!3d-8.290682991744081!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd66e5eaaaaaaab%3A0xd7fa90678b0cd568!2sPantai%20Bambang!5e0!3m2!1sen!2sid!4v1750014389636!5m2!1sen!2sid',
                'jam_operasional' => '06:00 - 17:00',
                'harga_tiket' => 5000.00,
                'admin_id' => $adminId,
                'kategori_id' => $kategoriPantai,
            ],
            [
                'nama' => 'Air Terjun Kapas Biru',
                'deskripsi' => 'Air terjun dengan aliran air yang menyerupai kapas putih yang lembut. Memiliki kolam alami yang jernih dan area piknik yang nyaman. Akses mudah dan cocok untuk wisata keluarga.',
                'lokasi' => 'Desa Pronojiwo, Kecamatan Pronojiwo, Kabupaten Lumajang, Jawa Timur',
                'link_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.7794634279235!2d112.93374667595856!3d-8.224919591807755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd614708a8a9a37%3A0xe43ba62d46777f16!2sKapas%20Biru%20Waterfall!5e0!3m2!1sen!2sid!4v1750014424722!5m2!1sen!2sid',
                'jam_operasional' => '07:00 - 16:00',
                'harga_tiket' => 10000.00,
                'admin_id' => $adminId,
                'kategori_id' => $kategoriAirTerjun,
            ],
            [
                'nama' => 'B29 Argosari',
                'deskripsi' => 'Negeri di atas awan dengan pemandangan matahari terbit yang spektakuler. Spot camping dan fotografi yang populer dengan latar belakang Gunung Semeru. Dapat ditempuh dengan kendaraan roda dua atau empat.',
                'lokasi' => 'Desa Argosari, Kecamatan Senduro, Kabupaten Lumajang, Jawa Timur',
                'link_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.383782861409!2d112.99225847595632!3d-7.959231792065444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd647e555555555%3A0x5cf5334088ce710e!2sPuncak%20B29!5e0!3m2!1sen!2sid!4v1750014481427!5m2!1sen!2sid',
                'jam_operasional' => '24 Jam',
                'harga_tiket' => 5000.00,
                'admin_id' => $adminId,
                'kategori_id' => $kategoriWisataAlam,
            ],
        ];

        DB::table('tempat_wisata')->insert($tempatWisata);
    }
}
