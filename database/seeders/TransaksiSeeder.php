<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use App\Models\User;
use App\Models\TempatWisata;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all pengunjung users
        $pengunjungs = User::where('role', 'pengunjung')->get();

        // Get all tempat wisata
        $wisatas = TempatWisata::all();

        // Generate sample transactions for each pengunjung
        foreach ($pengunjungs as $pengunjung) {
            // Create 2-4 random transactions per user
            $numberOfTransactions = rand(2, 4);

            for ($i = 0; $i < $numberOfTransactions; $i++) {
                $wisata = $wisatas->random();
                $jumlahTiket = rand(1, 5);
                $totalBayar = $wisata->harga_tiket * $jumlahTiket;

                // Generate random date within last 30 days
                $date = now()->subDays(rand(0, 30));

                // Determine status based on date
                $statusPembayaran = $date->lt(now()->subDays(2)) ? 'selesai' : 'pending';
                $statusTiket = $date->lt(now()->subDays(1)) ? 'sudah_digunakan' : 'belum_digunakan';

                // Create QR Code path
                $qrCodePath = 'qrcodes/ticket-' . Str::random(10) . '.png';

                Transaksi::create([
                    'user_id' => $pengunjung->id,
                    'wisata_id' => $wisata->id,
                    'tanggal_booking' => $date->format('Y-m-d'),
                    'jumlah_tiket' => $jumlahTiket,
                    'total_bayar' => $totalBayar,
                    'status_pembayaran' => $statusPembayaran,
                    'status_tiket' => $statusTiket,
                    'qr_code_path' => $qrCodePath,
                    'created_at' => $date,
                    'updated_at' => $date->addHours(rand(1, 24))
                ]);
            }
        }
    }
}
