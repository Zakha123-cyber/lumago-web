<?php

namespace App\Http\Controllers\Admin\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\TempatWisata;
use App\Models\KategoriWisata;
use App\Models\User;
use App\Models\GambarWisata;
use Illuminate\Http\Request;

class SuperAdminWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tempatWisata = TempatWisata::with(['admin', 'kategori', 'gambarWisata'])
            ->latest()
            ->paginate(10);

        return view('superadmin.wisata.index', compact('tempatWisata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriWisata::all();
        $adminWisata = User::where('role', 'adminwisata')
            ->doesntHave('tempatWisata')
            ->get();

        return view('superadmin.wisata.create', compact('kategori', 'adminWisata'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'admin_id' => 'required|exists:users,id',
            'kategori_id' => 'required|exists:kategori_wisata,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'link_maps' => 'required|url',
            'jam_operasional' => 'required|string',
            'harga_tiket' => 'required|numeric|min:0',
        ]);

        $tempatWisata = TempatWisata::create($validated);

        return redirect()
            ->route('superadmin.wisata.index')
            ->with('success', 'Tempat wisata berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $wisata = TempatWisata::with(['admin', 'kategori', 'gambarWisata'])
            ->findOrFail($id);

        return view('superadmin.wisata.show', compact('wisata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $wisata = TempatWisata::findOrFail($id);
        $kategori = KategoriWisata::all();
        $adminWisata = User::where('role', 'adminwisata')
            ->orWhere('id', $wisata->admin_id) // agar admin lama tetap muncul di dropdown
            ->get();

        return view('superadmin.wisata.edit', compact('wisata', 'kategori', 'adminWisata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $wisata = TempatWisata::findOrFail($id);

        $validated = $request->validate([
            'admin_id' => 'required|exists:users,id',
            'kategori_id' => 'required|exists:kategori_wisata,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'link_maps' => 'required|url',
            'jam_operasional' => 'required|string',
            'harga_tiket' => 'required|numeric|min:0',
        ]);

        $wisata->update($validated);

        return redirect()
            ->route('superadmin.wisata.index')
            ->with('success', 'Tempat wisata berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $wisata = TempatWisata::findOrFail($id);
        $wisata->delete();

        return redirect()
            ->route('superadmin.wisata.index')
            ->with('success', 'Tempat wisata berhasil dihapus');
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_wisata,nama_kategori',
        ]);

        KategoriWisata::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function storeGambar(Request $request)
    {
        $request->validate([
            'wisata_id' => 'required|exists:tempat_wisata,id',
            'gambar' => 'required',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('images', $filename, 'public');

                GambarWisata::create([
                    'wisata_id' => $request->wisata_id,
                    'path_gambar' => $filename,
                ]);
            }
        }

        return back()->with('success', 'Gambar berhasil ditambahkan.');
    }
}
