@extends('layouts.superadmin')

@section('content')
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Tempat Wisata</h2>
                <p class="mt-1 text-lg text-gray-400">Kelola data tempat wisata</p>
            </div>
            <a href="{{ route('superadmin.wisata.create') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-green-500 rounded-lg hover:bg-green-600">
                <i class="mr-2 fa-solid fa-plus"></i>
                Tambah Tempat Wisata
            </a>
        </div>

        {{-- Alert Success --}}
        @if (session('success'))
            <div class="p-4 text-green-500 rounded-lg bg-green-500/10">
                {{ session('success') }}
            </div>
        @endif

        {{-- Wisata List --}}
        <div class="border rounded-lg bg-gray-800/50 border-white/10">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b border-white/10">
                            <th class="p-4 text-left text-gray-400">Nama Wisata</th>
                            <th class="p-4 text-left text-gray-400">Kategori</th>
                            <th class="p-4 text-left text-gray-400">Admin</th>
                            <th class="p-4 text-left text-gray-400">Harga Tiket</th>
                            <th class="p-4 text-center text-gray-400">Gambar</th>
                            <th class="p-4 text-center text-gray-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @forelse($tempatWisata as $wisata)
                            <tr class="hover:bg-white/5">
                                <td class="p-4">
                                    <div>
                                        <h3 class="font-medium text-white">{{ $wisata->nama }}</h3>
                                        <p class="text-sm text-gray-400">{{ Str::limit($wisata->lokasi, 50) }}</p>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span class="px-3 py-1 text-sm text-blue-400 rounded-full bg-blue-400/10">
                                        {{ $wisata->kategori->nama_kategori ?? 'Tidak ada kategori' }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span class="text-white">{{ $wisata->admin->name }}</span>
                                </td>
                                <td class="p-4">
                                    <span class="text-white">Rp
                                        {{ number_format($wisata->harga_tiket, 0, ',', '.') }}</span>
                                </td>
                                <td class="p-4">
                                    @if ($wisata->gambarWisata->count() > 0)
                                        <img src="{{ asset('storage/images/' . $wisata->gambarWisata->first()->path_gambar) }}"
                                            alt="{{ $wisata->nama }}" class="object-cover w-16 h-16 mx-auto rounded-lg">
                                    @else
                                        <span class="text-gray-400">No image</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('superadmin.wisata.show', $wisata->id) }}"
                                            class="p-2 text-white transition-colors rounded-lg hover:bg-white/10"
                                            title="Detail">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('superadmin.wisata.edit', $wisata->id) }}"
                                            class="p-2 text-white transition-colors rounded-lg hover:bg-white/10"
                                            title="Edit">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('superadmin.wisata.destroy', $wisata->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus tempat wisata ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-400 transition-colors rounded-lg hover:bg-white/10"
                                                title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-400">
                                    Tidak ada data tempat wisata
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Pagination --}}
            <div class="p-4 border-t border-white/10">
                {{ $tempatWisata->links() }}
            </div>
        </div>
    </div>
@endsection
