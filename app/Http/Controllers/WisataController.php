<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatWisata;

class WisataController extends Controller
{
    public function index(Request $request)
    {
        $query = TempatWisata::with(['kategori', 'gambarWisata']);

        // Handle search
        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        // Handle category filter
        if ($request->has('kategori')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('nama_kategori', $request->kategori);
            });
        }

        $wisata = $query->latest()->paginate(9);
        $categories = \App\Models\KategoriWisata::all();

        return view('booking-page.booking-page', compact('wisata', 'categories'));
    }
    public function show($id)
    {
        $wisata = TempatWisata::with(['kategori', 'gambarWisata', 'admin'])->findOrFail($id);
        return view('detail-page.detail-wisata', compact('wisata'));
    }
}
