<?php

namespace App\Http\Controllers\Admin\AdminWisata;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Zxing\QrReader; // gunakan library zxing-php untuk decode gambar QR
use Illuminate\Support\Facades\Log;

class AdminWisataScanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin-wisata.scan-tiket.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($order_id)
    {
        $transaksi = Transaksi::where('order_id', $order_id)->with(['user', 'wisata'])->first();

        if (!$transaksi) {
            return redirect()->route('admin-wisata.scan.index')->with('error', 'Tiket tidak ditemukan.');
        }

        $admin = auth()->user();
        $wisataIdAdmin = $admin->tempatWisata->id ?? null;
        if ($transaksi->wisata_id != $wisataIdAdmin) {
            return redirect()->route('admin-wisata.scan.index')->with('error', 'Tiket ini bukan untuk wisata yang Anda kelola.');
        }

        return view('admin-wisata.scan-tiket.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function verify(Request $request, $order_id)
    {
        $transaksi = Transaksi::where('order_id', $order_id)->first();

        if (!$transaksi) {
            return redirect()->route('admin-wisata.scan.index')->with('error', 'Tiket tidak ditemukan.');
        }

        if ($transaksi->status_tiket === 'sudah_digunakan') {
            return redirect()->route('admin-wisata.scan.show', $order_id)->with('error', 'Tiket sudah pernah digunakan.');
        }

        $transaksi->status_tiket = 'sudah_digunakan';
        $transaksi->save();

        return redirect()->route('admin-wisata.scan.show', $order_id)->with('success', 'Tiket berhasil diverifikasi & ditandai sudah digunakan.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'qr_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $file = $request->file('qr_image');
        $path = $file->store('temp_qr', 'public');
        $qrPath = Storage::disk('public')->path($path);

        $qrcode = new \Zxing\QrReader($qrPath);
        $order_id = $qrcode->text();

        Storage::disk('public')->delete($path);

        if (empty($order_id)) {
            return back()->with('error', 'QR Code tidak terdeteksi atau tidak valid');
        }

        $transaksi = Transaksi::where('order_id', $order_id)->first();
        if (!$transaksi) {
            return back()->with('error', 'Order ID tidak ditemukan');
        }

        // Validasi wisata
        $admin = auth()->user();
        $wisataIdAdmin = $admin->tempatWisata->id ?? null;
        if ($transaksi->wisata_id != $wisataIdAdmin) {
            return back()->with('error', 'Tiket ini bukan untuk wisata yang Anda kelola.');
        }

        // Redirect ke halaman show
        return redirect()->route('admin-wisata.scan.show', $order_id);
    }
}
