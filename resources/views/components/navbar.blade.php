<nav class="fixed top-0 z-50 w-full backdrop-blur-md" x-data="{ mobileMenuOpen: false }">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
        {{-- Logo --}}
        <a href="{{ route('landing.index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('storage/images/logo-lumago.png') }}" class="h-8" alt="LumaGO Logo" />
        </a>

        {{-- Login/Profile Button and Mobile Menu Toggle --}}
        <div class="flex items-center space-x-3 md:order-2 md:space-x-0 rtl:space-x-reverse">
            {{-- Auth buttons --}}
            @auth
                {{-- Profile Dropdown for Authenticated Users --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center px-6 py-2 text-lg font-medium text-white transition-all duration-300 bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 w-48 py-2 mt-2 bg-white rounded-lg shadow-xl">
                        <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                            <i class="mr-2 fas fa-user"></i> Profile
                        </a>
                        <a href="{{ route('profile.bookings') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                            <i class="mr-2 fas fa-history"></i> Riwayat
                        </a>
                        <hr class="my-2 border-gray-200">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-left text-gray-800 hover:bg-gray-100">
                                <i class="mr-2 fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                {{-- Login Button for Guests --}}
                <a href="{{ route('login', ['intended' => url()->current()]) }}"
                    class="px-6 py-2 text-lg font-medium text-white transition-all duration-300 bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                    Login
                </a>
            @endauth

            {{-- Mobile Menu Button --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-white rounded-lg md:hidden hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-green-500"
                aria-controls="navbar-cta" :aria-expanded="mobileMenuOpen">
                <span class="sr-only">Toggle menu</span>
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Navigation Links --}}
        <div class="items-center justify-between w-full md:flex md:w-auto md:order-1" id="navbar-cta"
            x-show="mobileMenuOpen || window.innerWidth >= 768" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95" @click.away="mobileMenuOpen = false">
            <ul
                class="flex flex-col p-4 mt-4 font-medium rounded-lg md:p-0 bg-black/40 backdrop-blur-sm md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
                <li>
                    <a href="{{ route('landing.index') }}" @click="mobileMenuOpen = false"
                        class="block px-3 py-2 transition-colors duration-300 md:p-0 {{ request()->routeIs('landing.index') ? 'text-green-500' : 'text-white hover:text-green-500' }}"
                        aria-current="{{ request()->routeIs('landing.index') ? 'page' : 'false' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('wisata.index') }}" @click="mobileMenuOpen = false"
                        class="block px-3 py-2 transition-colors duration-300 md:p-0 {{ request()->routeIs('wisata.*') ? 'text-green-500' : 'text-white hover:text-green-500' }}">
                        Booking Wisata
                    </a>
                </li>
                <!-- If you have more menu items, add them here -->
            </ul>
        </div>
    </div>
</nav>
