<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatWisata;

class WisataController extends Controller
{
    public function show($id)
    {
        $wisata = TempatWisata::with(['kategori', 'gambarWisata', 'admin'])->findOrFail($id);
        return view('detail-page.detail-wisata', compact('wisata'));
    }
}
