<?php

namespace App\Http\Controllers\Admin\AdminWisata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminWisataPengunjungController extends Controller
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

        // Tabel pengunjung (transaksi)
        $pengunjungList = $query->paginate(15);

        // Statistik
        $totalPengunjungKeseluruhan = $wisata->transaksi()->count('user_id');
        if ($bulan) {
            $totalPengunjungBulan = $wisata->transaksi()->whereMonth('tanggal_booking', $bulan)->count('user_id');
        } else {
            $totalPengunjungBulan = $totalPengunjungKeseluruhan;
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

        // Data chart: total pengunjung per bulan (seluruh bulan)
        $chartPengunjung = [];
        foreach ($bulanList as $num => $nama) {
            $chartPengunjung[] = $wisata->transaksi()->whereMonth('tanggal_booking', $num)->count('user_id');
        }

        return view('admin-wisata.pengunjung.index', compact(
            'pengunjungList',
            'bulanList',
            'totalPengunjungKeseluruhan',
            'totalPengunjungBulan',
            'chartPengunjung'
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
