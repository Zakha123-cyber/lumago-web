<?php

namespace App\Http\Controllers;

use App\Models\TempatWisata;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Midtrans\Transaction;

class BookingController extends Controller
{
    public function create($id)
    {
        $wisata = TempatWisata::with('gambarWisata')->findOrFail($id);
        return view('booking-page.user-booking-page', compact('wisata'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'wisata_id' => 'required|exists:tempat_wisata,id',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'jumlah_tiket' => 'required|integer|min:1',
        ]);

        $wisata = TempatWisata::findOrFail($request->wisata_id);
        $total_bayar = $wisata->harga_tiket * $request->jumlah_tiket;
        $bookingCode = 'BK-' . time() . '-' . auth()->id();

        // Generate QR Code
        $qrCode = QrCode::size(200)->format('png')->generate($bookingCode);
        $qrPath = 'qrcodes/' . $bookingCode . '.png';
        Storage::disk('public')->put($qrPath, $qrCode);

        // Set Midtrans config
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction', false);
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized', true);
        \Midtrans\Config::$is3ds = config('midtrans.is3ds', true);

        // Buat parameter Snap
        $params = [
            'transaction_details' => [
                'order_id' => $bookingCode,
                'gross_amount' => (int) $total_bayar,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => [
                [
                    'id' => $wisata->id,
                    'price' => (int) $wisata->harga_tiket,
                    'quantity' => (int) $request->jumlah_tiket,
                    'name' => $wisata->nama,
                ]
            ]
        ];

        // Request Snap Token dari Midtrans
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Simpan transaksi
        $transaksi = Transaksi::create([
            'user_id' => auth()->id(),
            'wisata_id' => $request->wisata_id,
            'tanggal_booking' => $request->tanggal_booking,
            'jumlah_tiket' => $request->jumlah_tiket,
            'total_bayar' => $total_bayar,
            'qr_code_path' => $qrPath,
            'status_pembayaran' => 'pending',
            'status_tiket' => 'belum_digunakan',
            'snap_token' => $snapToken,
            'order_id' => $bookingCode,
        ]);

        // Kembali ke halaman yang sama dengan data yang diperlukan
        return redirect()->route('booking.create', $wisata->id)
            ->with('snapToken', $snapToken)
            ->with('transaksiId', $transaksi->id);
    }

    public function payment($id)
    {
        $transaksi = Transaksi::with('wisata')->findOrFail($id);

        // Check if user is authorized
        if ($transaksi->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if payment is already completed
        if ($transaksi->status_pembayaran === 'selesai') {
            return redirect()->route('booking.show-ticket', $transaksi->id);
        }

        return view('booking-page.payment', [
            'transaksi' => $transaksi,
            'snapToken' => $transaksi->snap_token
        ]);
    }

    public function success($id)
    {
        $transaksi = Transaksi::with(['user', 'wisata'])->findOrFail($id);

        // Set konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction', false);
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized', true);
        \Midtrans\Config::$is3ds = config('midtrans.is3ds', true);

        // Ambil status pembayaran dari Midtrans menggunakan order_id
        $status = \Midtrans\Transaction::status($transaksi->order_id);

        // Cek status pembayaran dan update database
        if (isset($status->transaction_status) && in_array($status->transaction_status, ['capture', 'settlement'])) {
            $transaksi->status_pembayaran = 'selesai';
            $transaksi->save();
        }

        return view('booking-page.booking-success', compact('transaksi'));
    }

    public function showTicket($id)
    {
        $transaksi = Transaksi::with(['user', 'wisata'])->findOrFail($id);

        // Check if user is authorized to view this ticket
        if ($transaksi->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if payment is completed
        if ($transaksi->status_pembayaran !== 'selesai') {
            return redirect()->route('profile.bookings')
                ->with('error', 'Pembayaran harus diselesaikan terlebih dahulu.');
        }

        return view('booking-page.show-ticket', compact('transaksi'));
    }
}
