@extends('layouts.superadmin')

@section('content')
    <div class="max-w-3xl px-4 mx-auto space-y-8">
        {{-- Header --}}
        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Edit Tempat Wisata</h2>
                <p class="mt-1 text-lg text-gray-400">Perbarui data tempat wisata</p>
            </div>
            <a href="{{ route('superadmin.wisata.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 transition-colors rounded-lg hover:text-white hover:bg-white/10">
                <i class="mr-2 fa-solid fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        <div class="p-6 border rounded-xl bg-gray-800/50 border-white/10">
            <form action="{{ route('superadmin.wisata.update', $wisata->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Admin Wisata Dropdown --}}
                <div>
                    <label for="admin_id" class="block mb-2 text-sm font-medium text-white">
                        Admin Wisata <span class="text-red-500">*</span>
                    </label>
                    <select id="admin_id" name="admin_id"
                        class="w-full px-4 py-2.5 text-base bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500/30 focus:border-green-500 text-gray-900"
                        required>
                        <option value="">Pilih Admin Wisata</option>
                        @foreach ($adminWisata as $admin)
                            <option value="{{ $admin->id }}"
                                {{ old('admin_id', $wisata->admin_id) == $admin->id ? 'selected' : '' }}>
                                {{ $admin->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('admin_id')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori Dropdown --}}
                <div>
                    <label for="kategori_id" class="block mb-2 text-sm font-medium text-white">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select id="kategori_id" name="kategori_id"
                        class="w-full px-4 py-2.5 text-base bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500/30 focus:border-green-500 text-gray-900"
                        required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}"
                                {{ old('kategori_id', $wisata->kategori_id) == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama Wisata --}}
                <div>
                    <label for="nama" class="block mb-2 text-sm font-medium text-white">
                        Nama Wisata <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $wisata->nama) }}"
                        class="w-full px-4 py-2.5 text-base bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500/30 focus:border-green-500 text-gray-900 placeholder:text-gray-500"
                        placeholder="Masukkan nama wisata" required>
                    @error('nama')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-white">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"
                        class="w-full px-4 py-2.5 text-base bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500/30 focus:border-green-500 text-gray-900 placeholder:text-gray-500"
                        placeholder="Masukkan deskripsi wisata" required>{{ old('deskripsi', $wisata->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lokasi --}}
                <div>
                    <label for="lokasi" class="block mb-2 text-sm font-medium text-white">
                        Lokasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $wisata->lokasi) }}"
                        class="w-full px-4 py-2.5 text-base bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500/30 focus:border-green-500 text-gray-900 placeholder:text-gray-500"
                        placeholder="Masukkan lokasi wisata" required>
                    @error('lokasi')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Link Maps --}}
                <div>
                    <label for="link_maps" class="block mb-2 text-sm font-medium text-white">
                        Link Google Maps <span class="text-red-500">*</span>
                    </label>
                    <input type="url" id="link_maps" name="link_maps"
                        value="{{ old('link_maps', $wisata->link_maps) }}"
                        class="w-full px-4 py-2.5 text-base bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500/30 focus:border-green-500 text-gray-900 placeholder:text-gray-500"
                        placeholder="Masukkan link Google Maps" required>
                    @error('link_maps')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jam Operasional --}}
                <div>
                    <label for="jam_operasional" class="block mb-2 text-sm font-medium text-white">
                        Jam Operasional <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="jam_operasional" name="jam_operasional"
                        value="{{ old('jam_operasional', $wisata->jam_operasional) }}"
                        class="w-full px-4 py-2.5 text-base bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500/30 focus:border-green-500 text-gray-900 placeholder:text-gray-500"
                        placeholder="Contoh: 08:00 - 17:00" required>
                    @error('jam_operasional')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga Tiket --}}
                <div>
                    <label for="harga_tiket" class="block mb-2 text-sm font-medium text-white">
                        Harga Tiket <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="harga_tiket" name="harga_tiket"
                        value="{{ old('harga_tiket', $wisata->harga_tiket) }}"
                        class="w-full px-4 py-2.5 text-base bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500/30 focus:border-green-500 text-gray-900 placeholder:text-gray-500"
                        placeholder="Masukkan harga tiket" required>
                    @error('harga_tiket')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white transition-colors bg-green-500 rounded-lg hover:bg-green-600">
                        <i class="mr-2 fa-solid fa-save"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
