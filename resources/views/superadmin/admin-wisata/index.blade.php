@extends('layouts.superadmin')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Admin Wisata</h2>
                <p class="mt-1 text-lg text-gray-400">Kelola admin untuk setiap tempat wisata</p>
            </div>
            <a href="{{ route('superadmin.admin-wisata.create') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-green-500 rounded-lg hover:bg-green-600">
                <i class="mr-2 fa-solid fa-plus"></i>
                Tambah Admin Wisata
            </a>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="p-4 text-green-500 rounded-lg bg-green-500/10">
                {{ session('success') }}
            </div>
        @endif

        <!-- Admin Wisata List -->
        <div class="border rounded-lg bg-gray-800/50 border-white/10">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b border-white/10">
                            <th class="p-4 text-left text-gray-400">Nama</th>
                            <th class="p-4 text-left text-gray-400">Email</th>
                            <th class="p-4 text-left text-gray-400">Tempat Wisata</th>
                            <th class="p-4 text-center text-gray-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @forelse($adminWisata as $admin)
                            <tr class="hover:bg-white/5">
                                <td class="p-4 text-white">{{ $admin->name }}</td>
                                <td class="p-4 text-white">{{ $admin->email }}</td>
                                <td class="p-4">
                                    @if ($admin->tempatWisata)
                                        <span class="px-3 py-1 text-sm text-green-400 rounded-full bg-green-400/10">
                                            {{ $admin->tempatWisata?->nama ?? 'Nama tidak tersedia' }}
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-sm text-yellow-400 rounded-full bg-yellow-400/10">
                                            Belum ada wisata
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('superadmin.admin-wisata.edit', $admin->id) }}"
                                            class="p-2 text-white transition-colors rounded-lg hover:bg-white/10"
                                            title="Edit">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('superadmin.admin-wisata.destroy', $admin->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
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
                                <td colspan="4" class="p-4 text-center text-gray-400">
                                    Tidak ada data admin wisata
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="p-4 border-t border-white/10">
                {{ $adminWisata->links() }}
            </div>
        </div>
    </div>
@endsection
