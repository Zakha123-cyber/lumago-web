<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen p-4">
        <!-- Login Container with Shadow -->
        <div
            class="flex w-full max-w-6xl overflow-hidden border shadow-2xl rounded-2xl border-white/10 bg-gray-800/50 backdrop-blur-xl">
            <!-- Left Side - Nature Image -->
            <div class="relative hidden lg:block lg:w-1/2">
                <img src="{{ asset('storage/images/tumpak-sewu-1.jpeg') }}" alt="Nature Background"
                    class="absolute inset-0 object-cover w-full h-full rounded-l-2xl"
                    onerror="this.src='https://images.unsplash.com/photo-1501785888041-af3ef285b470?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80'" />
                <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 to-transparent rounded-l-2xl">
                    <div class="max-w-xl p-12 mt-32 text-white">
                        <h1 class="mb-4 text-4xl font-bold">Jelajahi Keindahan Alam Indonesia</h1>
                        <p class="text-lg text-gray-200">Temukan destinasi wisata alam terbaik untuk pengalaman tak
                            terlupakan</p>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="flex items-center justify-center w-full p-8 lg:w-1/2">
                <div class="w-full max-w-md space-y-8">
                    <!-- Logo -->
                    <div class="text-center">
                        <img src="{{ asset('images/logo-lumago.png') }}" alt="LumaGO Logo" class="h-12 mx-auto mb-4">
                        <h2 class="text-3xl font-bold text-white">Selamat Datang Kembali</h2>
                        <p class="mt-2 text-gray-400">Masuk untuk melanjutkan perjalanan Anda</p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
                            <x-text-input id="email" type="email" name="email" :value="old('email')" required
                                autofocus autocomplete="username"
                                class="block w-full mt-1 text-gray-300 rounded-lg bg-gray-800/80 border-white/10 focus:border-green-500 focus:ring-green-500" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="text-gray-300" />
                            <x-text-input id="password" type="password" name="password" required
                                autocomplete="current-password"
                                class="block w-full mt-1 text-gray-300 rounded-lg bg-gray-800/80 border-white/10 focus:border-green-500 focus:ring-green-500" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" name="remember"
                                    class="text-green-500 rounded bg-gray-800/80 border-white/10 focus:ring-green-500">
                                <span class="ml-2 text-sm text-gray-400">{{ __('Ingat Saya') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm text-green-500 hover:text-green-400"
                                    href="{{ route('password.request') }}">
                                    {{ __('Lupa Password?') }}
                                </a>
                            @endif
                        </div>

                        <!-- Login Button -->
                        <button type="submit"
                            class="w-full px-4 py-3 font-medium text-white transition-colors bg-green-500 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                            {{ __('Masuk') }}
                        </button>

                        <!-- Register Link -->
                        <p class="text-sm text-center text-gray-400">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="font-medium text-green-500 hover:text-green-400">
                                Daftar sekarang
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
