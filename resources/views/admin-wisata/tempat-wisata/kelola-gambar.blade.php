@extends('layouts.superadmin')

@section('content')
    <div class="max-w-5xl px-4 py-10 mx-auto">
        <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Kelola Gambar Wisata</h2>
                <p class="mt-1 text-lg text-gray-400">Tambah atau hapus gambar untuk tempat wisata Anda</p>
            </div>
            <a href="{{ route('admin-wisata.wisata.index') }}"
                class="inline-flex items-center px-4 py-2 text-white transition bg-gray-700 rounded-lg hover:bg-gray-600">
                <i class="mr-2 fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- Button Tambah Gambar --}}
        <div class="flex justify-end mb-6">
            <button onclick="document.getElementById('modalTambahGambar').showModal()"
                class="inline-flex items-center px-4 py-2 font-medium text-white transition bg-green-500 rounded-lg hover:bg-green-600">
                <i class="mr-2 fa-solid fa-plus"></i> Tambah Gambar
            </button>
        </div>

        {{-- Tabel List Gambar --}}
        <div class="overflow-x-auto border shadow-xl rounded-xl border-white/10 bg-gray-800/60">
            <table class="min-w-full divide-y divide-white/10">
                <thead class="bg-gray-900/80">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-300 w-[5%]">#</th>
                        <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-300 w-[35%]">Preview</th>
                        <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-300 w-[45%]">Info File</th>
                        <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-300 w-[15%] text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($wisata->gambarWisata as $gambar)
                        <tr class="transition duration-200 hover:bg-gray-900/40">
                            <td class="px-6 py-4 text-sm text-gray-200 align-middle whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="relative group">
                                    <img src="{{ asset('storage/images/' . $gambar->path_gambar) }}" alt="Preview"
                                        class="w-[280px] h-[180px] object-cover rounded-lg shadow-md border border-white/10 transition duration-200 group-hover:scale-105" />

                                    {{-- Overlay saat hover --}}
                                    <div
                                        class="absolute inset-0 flex items-center justify-center gap-3 transition duration-200 rounded-lg opacity-0 bg-black/50 group-hover:opacity-100">
                                        {{-- Preview Button --}}
                                        <a href="{{ asset('storage/images/' . $gambar->path_gambar) }}" target="_blank"
                                            class="inline-flex items-center justify-center w-10 h-10 transition rounded-full bg-white/20 hover:bg-white/30">
                                            <i class="text-lg text-white fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 align-middle">
                                <div class="flex flex-col gap-2">
                                    <p class="text-sm font-medium text-gray-200 break-all">
                                        {{ $gambar->path_gambar }}
                                    </p>
                                    <div class="flex items-center gap-2 text-xs text-gray-400">
                                        <i class="fa-regular fa-clock"></i>
                                        <span>Diupload {{ $gambar->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center align-middle">
                                <form method="POST"
                                    action="{{ route('admin-wisata.tempat-wisata.gambar.destroy', [$wisata->id, $gambar->id]) }}"
                                    onsubmit="return confirm('Yakin ingin menghapus gambar ini?')"
                                    class="inline-flex justify-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 px-4 py-2 text-white transition duration-200 rounded-lg bg-red-600/90 hover:bg-red-700">
                                        <i class="fa-solid fa-trash"></i>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center gap-3">
                                    <i class="text-5xl opacity-50 fa-regular fa-images"></i>
                                    <p>Belum ada gambar untuk tempat wisata ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Modal Tambah Gambar --}}
        <dialog id="modalTambahGambar" class="w-full max-w-md bg-gray-900 border shadow-xl rounded-xl border-white/10">
            <form method="POST" action="{{ route('admin-wisata.tempat-wisata.gambar.store', $wisata->id) }}"
                enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white">Tambah Gambar Wisata</h3>
                    <button type="button" onclick="document.getElementById('modalTambahGambar').close()"
                        class="text-xl text-gray-400 hover:text-white">&times;</button>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-200">Pilih Gambar</label>
                    <input type="file" name="gambar[]" accept="image/*" multiple required
                        class="block w-full text-gray-200 bg-gray-700 border rounded-lg border-white/10 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-green-500 file:text-white hover:file:bg-green-600" />
                    <div class="mt-1 text-xs text-gray-400">Format: JPG, PNG, WEBP. Maksimal 2MB per gambar. Bisa pilih
                        lebih dari satu.</div>
                    @error('gambar')
                        <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('modalTambahGambar').close()"
                        class="px-4 py-2 text-white transition bg-gray-700 rounded-lg hover:bg-gray-600">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 font-semibold text-white transition bg-green-500 rounded-lg hover:bg-green-600">
                        <i class="mr-2 fa-solid fa-upload"></i> Upload
                    </button>
                </div>
            </form>
        </dialog>
    </div>
@endsection
