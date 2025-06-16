<?php

namespace App\Http\Controllers\Admin\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TempatWisata;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SuperAdminDashboardController extends Controller
{
    public function index()
    {
        // Count statistics
        $totalWisata = TempatWisata::count();
        $totalAdminWisata = User::where('role', 'adminwisata')->count();
        $totalUsers = User::where('role', 'user')->count();
        $totalTransaksi = Transaksi::count();

        // Get total pendapatan
        $totalPendapatan = Transaksi::where('status_pembayaran', 'selesai')
            ->sum('total_bayar');

        // Get transaksi data untuk chart (30 hari terakhir)
        $transaksiChart = Transaksi::where('status_pembayaran', 'selesai')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Get latest transaksi
        $latestTransaksi = Transaksi::with(['user', 'wisata'])
            ->latest()
            ->take(5)
            ->get();

        // Get top wisata
        $topWisata = TempatWisata::withCount(['transaksi' => function ($query) {
            $query->where('status_pembayaran', 'selesai');
        }])
            ->orderBy('transaksi_count', 'desc')
            ->take(5)
            ->get();

        return view('superadmin.dashboard', compact(
            'totalWisata',
            'totalAdminWisata',
            'totalUsers',
            'totalTransaksi',
            'totalPendapatan',
            'transaksiChart',
            'latestTransaksi',
            'topWisata'
        ));
    }
}
