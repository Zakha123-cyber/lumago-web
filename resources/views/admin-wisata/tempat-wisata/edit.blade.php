@extends('layouts.superadmin')

@section('content')
    <div class="max-w-5xl px-4 py-10 mx-auto">
        <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Edit Tempat Wisata</h2>
                <p class="mt-1 text-lg text-gray-400">Perbarui informasi tempat wisata yang Anda kelola</p>
            </div>
            <a href="{{ route('admin-wisata.wisata.index') }}"
                class="inline-flex items-center px-4 py-2 text-white transition bg-gray-700 rounded-lg hover:bg-gray-600">
                <i class="mr-2 fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin-wisata.wisata.update', $wisata->id) }}" method="POST"
            class="p-8 space-y-8 border shadow-xl bg-gradient-to-br from-gray-800 via-gray-900 to-gray-800 border-white/10 rounded-2xl">
            @csrf
            @method('PUT')

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-200">Nama Tempat Wisata</label>
                    <input type="text" name="nama" value="{{ old('nama', $wisata->nama) }}" required
                        class="w-full px-4 py-2 text-gray-900 placeholder-gray-400 bg-gray-700 border rounded-lg border-white/10 focus:ring-2 focus:ring-green-500/30 focus:border-green-500"
                        placeholder="Nama Tempat Wisata">
                    @error('nama')
                        <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-200">Kategori</label>
                    <select name="kategori_id" required
                        class="w-full px-4 py-2 text-gray-900 bg-gray-700 border rounded-lg border-white/10 focus:ring-2 focus:ring-green-500/30 focus:border-green-500">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoriList as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ old('kategori_id', $wisata->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-200">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $wisata->lokasi) }}" required
                        class="w-full px-4 py-2 text-gray-900 placeholder-gray-400 bg-gray-700 border rounded-lg border-white/10 focus:ring-2 focus:ring-green-500/30 focus:border-green-500"
                        placeholder="Alamat lengkap">
                    @error('lokasi')
                        <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-200">Jam Operasional</label>
                    <input type="text" name="jam_operasional"
                        value="{{ old('jam_operasional', $wisata->jam_operasional) }}" required
                        class="w-full px-4 py-2 text-gray-900 placeholder-gray-400 bg-gray-700 border rounded-lg border-white/10 focus:ring-2 focus:ring-green-500/30 focus:border-green-500"
                        placeholder="Contoh: 08.00 - 17.00">
                    @error('jam_operasional')
                        <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-200">Harga Tiket</label>
                    <input type="number" name="harga_tiket" value="{{ old('harga_tiket', $wisata->harga_tiket) }}"
                        required min="0"
                        class="w-full px-4 py-2 text-gray-900 placeholder-gray-400 bg-gray-700 border rounded-lg border-white/10 focus:ring-2 focus:ring-green-500/30 focus:border-green-500"
                        placeholder="Harga Tiket">
                    @error('harga_tiket')
                        <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-200">Link Google Maps</label>
                    <input type="url" name="link_maps" value="{{ old('link_maps', $wisata->link_maps) }}"
                        class="w-full px-4 py-2 text-gray-900 placeholder-gray-400 bg-gray-700 border rounded-lg border-white/10 focus:ring-2 focus:ring-green-500/30 focus:border-green-500"
                        placeholder="https://maps.google.com/...">
                    @error('link_maps')
                        <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-200">Deskripsi</label>
                <textarea name="deskripsi" rows="5" required
                    class="w-full px-4 py-2 text-gray-900 placeholder-gray-400 bg-gray-700 border rounded-lg border-white/10 focus:ring-2 focus:ring-green-500/30 focus:border-green-500"
                    placeholder="Deskripsi lengkap tempat wisata">{{ old('deskripsi', $wisata->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 font-semibold text-white transition bg-green-500 rounded-lg hover:bg-green-600">
                    <i class="mr-2 fa-solid fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
