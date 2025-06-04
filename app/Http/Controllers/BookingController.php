<?php

namespace App\Http\Controllers;

use App\Models\TempatWisata;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

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

        // Generate unique booking code
        $bookingCode = 'BK-' . time() . '-' . auth()->id();

        $logoPath = public_path('storage/images/logo-lumago.png');

        // Generate QR Code with booking information
        $qrCode = QrCode::size(200)->format('png')->merge('/public/images/logo-lumago.png', .4)->generate($bookingCode);

        $qrPath = 'qrcodes/' . $bookingCode . '.png';
        Storage::disk('public')->put($qrPath, $qrCode);

        $transaksi = Transaksi::create([
            'user_id' => auth()->id(),
            'wisata_id' => $request->wisata_id,
            'tanggal_booking' => $request->tanggal_booking,
            'jumlah_tiket' => $request->jumlah_tiket,
            'total_bayar' => $total_bayar,
            'qr_code_path' => $qrPath,
            'status_pembayaran' => 'pending',
            'status_tiket' => 'belum_digunakan'
        ]);

        return redirect()->route('booking.success', $transaksi->id)
            ->with('success', 'Booking berhasil dibuat!');
    }

    public function success($id)
    {
        $transaksi = Transaksi::with(['user', 'wisata'])->findOrFail($id);
        return view('booking-page.booking-success', compact('transaksi'));
    }
}
