<?php

namespace App\Http\Controllers\Admin\AdminWisata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TempatWisata;
use App\Models\KategoriWisata;
use App\Models\GambarWisata;
use Illuminate\Support\Facades\Storage;

class AdminWisataWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = auth()->user();
        $wisata = $admin->tempatWisata()->with(['kategori', 'gambarWisata', 'transaksi'])->firstOrFail();
        return view('admin-wisata.tempat-wisata.index', compact('wisata'));
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
    public function edit()
    {
        $admin = auth()->user();
        $wisata = $admin->tempatWisata()->firstOrFail();
        $kategoriList = KategoriWisata::orderBy('nama_kategori')->get();
        return view('admin-wisata.tempat-wisata.edit', compact('wisata', 'kategoriList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $admin = auth()->user();
        $wisata = $admin->tempatWisata()->firstOrFail();

        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'kategori_id'    => 'required|exists:kategori_wisata,id',
            'lokasi'         => 'required|string|max:255',
            'jam_operasional' => 'required|string|max:100',
            'harga_tiket'    => 'required|numeric|min:0',
            'link_maps'      => 'nullable|url',
            'deskripsi'      => 'required|string',
        ]);

        $wisata->update($validated);

        return redirect()
            ->route('admin-wisata.wisata.index')
            ->with('success', 'Data tempat wisata berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function gambar()
    {
        $admin = auth()->user();
        $wisata = $admin->tempatWisata()->with('gambarWisata')->firstOrFail();
        return view('admin-wisata.tempat-wisata.kelola-gambar', compact('wisata'));
    }

    public function gambarStore(Request $request, $wisataId)
    {
        $admin = auth()->user();
        $wisata = $admin->tempatWisata()->where('id', $wisataId)->firstOrFail();

        $request->validate([
            'gambar' => 'required',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('images', $filename, 'public');

                GambarWisata::create([
                    'wisata_id' => $wisata->id,
                    'path_gambar' => $filename,
                ]);
            }
        }

        return redirect()->route('admin-wisata.tempat-wisata.gambar')->with('success', 'Gambar berhasil ditambahkan.');
    }

    public function gambarDestroy($wisataId, $gambarId)
    {
        $admin = auth()->user();
        $wisata = $admin->tempatWisata()->where('id', $wisataId)->firstOrFail();
        $gambar = $wisata->gambarWisata()->where('id', $gambarId)->firstOrFail();

        // Hapus file dari storage jika ada
        if ($gambar->path_gambar && Storage::disk('public')->exists('images/' . $gambar->path_gambar)) {
            Storage::disk('public')->delete('images/' . $gambar->path_gambar);
        }

        $gambar->delete();

        return redirect()->route('admin-wisata.tempat-wisata.gambar')->with('success', 'Gambar berhasil dihapus.');
    }
}
