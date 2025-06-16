<aside class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0">
    <div class="h-full px-3 py-4 overflow-y-auto border-r bg-gray-900/95 backdrop-blur-xl border-white/10">
        <!-- Logo Section with larger size and better spacing -->
        <div class="flex items-center justify-center mb-3">
            <img src="{{ asset('images/logo-lumago.png') }}" alt="LumaGO Logo"
                class="w-24 h-12 transition-transform duration-300 hover:scale-105">
        </div>

        <!-- Navigation Menu Divider -->
        <div class="h-px mb-6 bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>

        <!-- Navigation -->
        <ul class="space-y-2 font-medium">
            @if (auth()->user()->role === 'superadmin')
                <li>
                    <a href="{{ route('superadmin.dashboard.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-800/80 group {{ request()->routeIs('superadmin.dashboard.*') ? 'bg-gray-800/80' : '' }}">
                        <i class="w-5 h-5 text-green-400 transition-all fa-solid fa-gauge-high"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('superadmin.admin-wisata.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-800/80 group {{ request()->routeIs('superadmin.admin-wisata.*') ? 'bg-gray-800/80' : '' }}">
                        <i class="w-5 h-5 text-green-400 transition-all fa-solid fa-users-gear"></i>
                        <span class="ml-3">Admin Wisata</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('superadmin.wisata.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-800/80 group {{ request()->routeIs('superadmin.wisata.*') ? 'bg-gray-800/80' : '' }}">
                        <i class="w-5 h-5 text-green-400 transition-all fa-solid fa-location-dot"></i>
                        <span class="ml-3">Tempat Wisata</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('superadmin.transaksi.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-800/80 group {{ request()->routeIs('superadmin.transaksi.*') ? 'bg-gray-800/80' : '' }}">
                        <i class="w-5 h-5 text-green-400 transition-all fa-solid fa-receipt"></i>
                        <span class="ml-3">Transaksi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('superadmin.users.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-800/80 group {{ request()->routeIs('superadmin.users.*') ? 'bg-gray-800/80' : '' }}">
                        <i class="w-5 h-5 text-green-400 transition-all fa-solid fa-users"></i>
                        <span class="ml-3">Pengguna</span>
                    </a>
                </li>
            @else
                <!-- AdminWisata Menu Items -->
                <li>
                    <a href="{{ route('admin-wisata.wisata.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-800/80 group {{ request()->routeIs('admin-wisata.wisata.*') ? 'bg-gray-800/80' : '' }}">
                        <i class="w-5 h-5 text-green-400 transition-all fa-solid fa-location-dot"></i>
                        <span class="ml-3">Tempat Wisata</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin-wisata.transaksi.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-800/80 group {{ request()->routeIs('admin-wisata.transaksi.*') ? 'bg-gray-800/80' : '' }}">
                        <i class="w-5 h-5 text-green-400 transition-all fa-solid fa-receipt"></i>
                        <span class="ml-3">Transaksi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin-wisata.pengunjung.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-800/80 group {{ request()->routeIs('admin-wisata.pengunjung.*') ? 'bg-gray-800/80' : '' }}">
                        <i class="w-5 h-5 text-green-400 transition-all fa-solid fa-users"></i>
                        <span class="ml-3">Pengunjung</span>
                    </a>
                </li>
            @endif
        </ul>

        <!-- Logout Button -->
        <div class="absolute bottom-4 left-4 right-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center w-full p-2 text-white rounded-lg hover:bg-gray-800/80 group">
                    <i class="w-5 h-5 text-red-400 transition-all fa-solid fa-right-from-bracket"></i>
                    <span class="ml-3">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
