<?php

namespace App\Http\Controllers\Admin\AdminWisata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminWisataDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', now()->format('Y-m'));
        $admin = auth()->user();

        // Ambil data wisata yang dikelola admin ini
        $wisata = $admin->tempatWisata;

        // Total pengunjung bulan ini
        $totalPengunjung = $wisata->transaksi()
            ->whereMonth('tanggal_booking', \Carbon\Carbon::parse($bulan)->month)
            ->whereYear('tanggal_booking', \Carbon\Carbon::parse($bulan)->year)
            ->sum('jumlah_tiket');

        // Total user seluruh aplikasi
        $totalUser = \App\Models\User::count();

        // Total pendapatan bulan ini
        $totalPendapatan = $wisata->transaksi()
            ->whereMonth('tanggal_booking', \Carbon\Carbon::parse($bulan)->month)
            ->whereYear('tanggal_booking', \Carbon\Carbon::parse($bulan)->year)
            ->sum('total_bayar');

        // Total transaksi bulan ini
        $totalTransaksi = $wisata->transaksi()
            ->whereMonth('tanggal_booking', \Carbon\Carbon::parse($bulan)->month)
            ->whereYear('tanggal_booking', \Carbon\Carbon::parse($bulan)->year)
            ->count();

        // Grafik pengunjung per hari bulan ini
        $chartPengunjung = $wisata->transaksi()
            ->selectRaw('DATE(tanggal_booking) as date, SUM(jumlah_tiket) as total')
            ->whereMonth('tanggal_booking', \Carbon\Carbon::parse($bulan)->month)
            ->whereYear('tanggal_booking', \Carbon\Carbon::parse($bulan)->year)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Grafik pendapatan per hari bulan ini
        $chartPendapatan = $wisata->transaksi()
            ->selectRaw('DATE(tanggal_booking) as date, SUM(total_bayar) as total')
            ->whereMonth('tanggal_booking', \Carbon\Carbon::parse($bulan)->month)
            ->whereYear('tanggal_booking', \Carbon\Carbon::parse($bulan)->year)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Transaksi terbaru bulan ini
        $latestTransaksi = $wisata->transaksi()
            ->with('user')
            ->whereMonth('tanggal_booking', \Carbon\Carbon::parse($bulan)->month)
            ->whereYear('tanggal_booking', \Carbon\Carbon::parse($bulan)->year)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // Total user unik yang pernah bertransaksi di wisata ini
        $totalUserUnik = $wisata->transaksi()
            ->select('user_id')
            ->distinct()
            ->count('user_id');

        return view('admin-wisata.dashboard', compact(
            'bulan',
            'totalPengunjung',
            'totalUser',
            'totalPendapatan',
            'totalTransaksi',
            'chartPengunjung',
            'chartPendapatan',
            'latestTransaksi',
            'totalUserUnik'
        ));
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
    public function show(string $id)
    {
        //
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
}
