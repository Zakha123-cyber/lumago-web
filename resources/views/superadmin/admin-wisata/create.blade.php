@extends('layouts.superadmin')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Tambah Admin Wisata</h2>
                <p class="mt-1 text-lg text-gray-400">Tambah admin baru untuk mengelola tempat wisata</p>
            </div>
            <a href="{{ route('superadmin.admin-wisata.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-200 transition-colors rounded-lg hover:text-white hover:bg-white/10">
                <i class="mr-2 fa-solid fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        <!-- Form Card -->
        <div class="p-6 border rounded-xl bg-gray-800/50 border-white/10">
            <form action="{{ route('superadmin.admin-wisata.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Name Input -->
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-white">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2.5 text-base bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500/30 focus:border-green-500 text-gray-900 placeholder:text-gray-500"
                        placeholder="Masukkan nama lengkap" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Input -->
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-white">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2.5 text-base bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500/30 focus:border-green-500 text-gray-900 placeholder:text-gray-500"
                        placeholder="Masukkan alamat email" required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Input -->
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-white">
                        Nomor Telepon <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                        class="w-full px-4 py-2.5 text-base bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500/30 focus:border-green-500 text-gray-900 placeholder:text-gray-500"
                        placeholder="Masukkan nomor telepon" required>
                    @error('phone')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-white">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative flex items-center">
                        <input type="password" id="password" name="password"
                            class="w-full px-4 pr-10 py-2.5 text-base bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500/30 focus:border-green-500 text-gray-900 placeholder:text-gray-500"
                            placeholder="Masukkan password" required>
                        <div class="absolute cursor-pointer right-2">
                            <i class="text-gray-500 fa-solid fa-eye hover:text-gray-700" id="password-toggle-icon"
                                onclick="togglePassword('password')"></i>
                        </div>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Confirmation Input -->
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-white">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative flex items-center">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-4 pr-10 py-2.5 text-base bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500/30 focus:border-green-500 text-gray-900 placeholder:text-gray-500"
                            placeholder="Konfirmasi password" required>
                        <div class="absolute cursor-pointer right-2">
                            <i class="text-gray-500 fa-solid fa-eye hover:text-gray-700"
                                id="password-confirmation-toggle-icon"
                                onclick="togglePassword('password_confirmation')"></i>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white transition-colors bg-green-500 rounded-lg hover:bg-green-600">
                        <i class="mr-2 fa-solid fa-save"></i>
                        Simpan Admin Wisata
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function togglePassword(inputId) {
                const input = document.getElementById(inputId);
                const icon = document.getElementById(inputId + '-toggle-icon');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        </script>
    @endpush
@endsection
