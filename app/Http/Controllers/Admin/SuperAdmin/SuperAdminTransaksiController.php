<?php

namespace App\Http\Controllers\Admin\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;

class SuperAdminTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', now()->format('Y-m')); // default bulan ini

        $transaksi = Transaksi::with(['user', 'wisata'])
            ->when($bulan, function ($query, $bulan) {
                $query->whereMonth('tanggal_booking', Carbon::parse($bulan)->month)
                    ->whereYear('tanggal_booking', Carbon::parse($bulan)->year);
            })
            ->orderBy('tanggal_booking', 'desc')
            ->paginate(10);

        return view('superadmin.transaksi.index', compact('transaksi', 'bulan'));
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
