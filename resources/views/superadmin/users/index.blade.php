@extends('layouts.superadmin')

@section('content')
    <div class="px-4 mx-auto space-y-8 max-w-7xl">
        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Data Pengguna</h2>
                <p class="mt-1 text-lg text-gray-400">Kelola seluruh pengguna aplikasi</p>
            </div>
        </div>

        <div class="border rounded-xl bg-gray-800/50 border-white/10">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-900/80">
                            <th class="p-4 text-sm font-medium text-green-400">Nama</th>
                            <th class="p-4 text-sm font-medium text-green-400">Email</th>
                            <th class="p-4 text-sm font-medium text-green-400">No. HP</th>
                            <th class="p-4 text-sm font-medium text-green-400">Role</th>
                            <th class="p-4 text-sm font-medium text-green-400">Status OTP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="transition even:bg-gray-800/70 odd:bg-gray-700/60 hover:bg-green-900/20">
                                <td class="p-4 font-medium text-white">{{ $user->name }}</td>
                                <td class="p-4 text-white">{{ $user->email }}</td>
                                <td class="p-4 text-white">{{ $user->phone }}</td>
                                <td class="p-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold
                                @if ($user->role == 'superadmin') bg-blue-500/20 text-blue-400
                                @elseif($user->role == 'adminwisata') bg-green-500/20 text-green-400
                                @else bg-gray-500/20 text-gray-400 @endif">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    @if ($user->otp_verified)
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-400 rounded-full bg-green-500/10">
                                            <i class="mr-1 fa-solid fa-check"></i> Terverifikasi
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-400 rounded-full bg-red-500/10">
                                            <i class="mr-1 fa-solid fa-xmark"></i> Belum
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-400 bg-gray-800/70">
                                    Tidak ada data pengguna
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($users->hasPages())
                <div class="p-4 border-t border-white/10">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
