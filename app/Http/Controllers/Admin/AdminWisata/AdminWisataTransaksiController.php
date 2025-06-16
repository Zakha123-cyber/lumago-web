<?php

namespace App\Http\Controllers\Admin\AdminWisata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class AdminWisataTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $admin = auth()->user();
        $wisata = $admin->tempatWisata()->firstOrFail();

        // Filter bulan
        $bulan = $request->get('bulan');
        $query = $wisata->transaksi()->with('user')->orderByDesc('tanggal_booking');

        if ($bulan) {
            $query->whereMonth('tanggal_booking', $bulan);
        }

        $transaksiList = $query->paginate(15);

        // Statistik
        $totalTransaksiKeseluruhan = $wisata->transaksi()->count();
        $totalPendapatanKeseluruhan = $wisata->transaksi()->sum('total_bayar');

        // Statistik per bulan (mengikuti filter)
        if ($bulan) {
            $totalTransaksiBulan = $wisata->transaksi()->whereMonth('tanggal_booking', $bulan)->count();
            $totalPendapatanBulan = $wisata->transaksi()->whereMonth('tanggal_booking', $bulan)->sum('total_bayar');
        } else {
            $totalTransaksiBulan = $totalTransaksiKeseluruhan;
            $totalPendapatanBulan = $totalPendapatanKeseluruhan;
        }

        // Daftar bulan
        $bulanList = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Data chart: total transaksi & pendapatan per bulan (seluruh bulan)
        $chartTransaksi = [];
        $chartPendapatan = [];
        foreach ($bulanList as $num => $nama) {
            $chartTransaksi[] = $wisata->transaksi()->whereMonth('tanggal_booking', $num)->count();
            $chartPendapatan[] = $wisata->transaksi()->whereMonth('tanggal_booking', $num)->sum('total_bayar');
        }

        return view('admin-wisata.transaksi.index', compact(
            'transaksiList',
            'bulanList',
            'totalTransaksiKeseluruhan',
            'totalTransaksiBulan',
            'totalPendapatanKeseluruhan',
            'totalPendapatanBulan',
            'chartTransaksi',
            'chartPendapatan'
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
        $admin = auth()->user();
        $transaksi = Transaksi::with(['user', 'wisata'])
            ->where('id', $id)
            ->where('wisata_id', $admin->tempatWisata->id ?? null)
            ->firstOrFail();

        return view('admin-wisata.transaksi.show', compact('transaksi'));
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
