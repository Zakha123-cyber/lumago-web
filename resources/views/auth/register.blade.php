<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen p-4">
        <!-- Register Container with Shadow -->
        <div
            class="flex w-full max-w-6xl overflow-hidden border shadow-2xl rounded-2xl border-white/10 bg-gray-800/50 backdrop-blur-xl">
            <!-- Left Side - Nature Image -->
            <div class="relative hidden lg:block lg:w-1/2">
                <img src="{{ asset('storage/images/b29.jpg') }}" alt="Nature Background"
                    class="absolute inset-0 object-cover object-[75%_center] w-full h-full rounded-l-2xl"
                    onerror="this.src='https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80'" />
                <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 to-transparent rounded-l-2xl">
                    <div class="max-w-xl p-12 mt-32 text-white">
                        <h1 class="mb-4 text-4xl font-bold">Mulai Petualangan Anda</h1>
                        <p class="text-lg text-gray-200">Bergabunglah bersama kami dan temukan keindahan wisata alam
                            Indonesia</p>
                    </div>
                </div>
            </div>

            <!-- Right Side - Register Form -->
            <div class="flex items-center justify-center w-full p-8 lg:w-1/2">
                <div class="w-full max-w-md space-y-8">
                    <!-- Logo -->
                    <div class="text-center">
                        <img src="{{ asset('images/logo-lumago.png') }}" alt="LumaGO Logo" class="h-12 mx-auto mb-4">
                        <h2 class="text-3xl font-bold text-white">Buat Akun Baru</h2>
                        <p class="mt-2 text-gray-400">Daftar untuk memulai perjalanan Anda</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Nama')" class="text-gray-300" />
                            <x-text-input id="name" type="text" name="name" :value="old('name')" required
                                autofocus autocomplete="name"
                                class="block w-full mt-1 text-gray-300 rounded-lg bg-gray-800/80 border-white/10 focus:border-green-500 focus:ring-green-500" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <x-input-label for="phone" :value="__('No. HP')" class="text-gray-300" />
                            <x-text-input id="phone" type="text" name="phone" :value="old('phone')" required
                                autocomplete="tel"
                                class="block w-full mt-1 text-gray-300 rounded-lg bg-gray-800/80 border-white/10 focus:border-green-500 focus:ring-green-500" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
                            <x-text-input id="email" type="email" name="email" :value="old('email')" required
                                autocomplete="username"
                                class="block w-full mt-1 text-gray-300 rounded-lg bg-gray-800/80 border-white/10 focus:border-green-500 focus:ring-green-500" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="text-gray-300" />
                            <x-text-input id="password" type="password" name="password" required
                                autocomplete="new-password"
                                class="block w-full mt-1 text-gray-300 rounded-lg bg-gray-800/80 border-white/10 focus:border-green-500 focus:ring-green-500" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-300" />
                            <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                                required autocomplete="new-password"
                                class="block w-full mt-1 text-gray-300 rounded-lg bg-gray-800/80 border-white/10 focus:border-green-500 focus:ring-green-500" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Register Button -->
                        <button type="submit"
                            class="w-full px-4 py-3 font-medium text-white transition-colors bg-green-500 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                            {{ __('Daftar') }}
                        </button>

                        <!-- Login Link -->
                        <p class="text-sm text-center text-gray-400">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="font-medium text-green-500 hover:text-green-400">
                                Masuk sekarang
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
