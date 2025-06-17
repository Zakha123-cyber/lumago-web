<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div
            class="w-full max-w-md p-8 space-y-6 border shadow-2xl rounded-2xl border-white/10 bg-gray-800/50 backdrop-blur-xl">
            <div class="text-center">
                <img src="{{ asset('images/logo-lumago.png') }}" alt="LumaGO Logo" class="h-12 mx-auto mb-4">
                <h2 class="text-2xl font-bold text-white">Verifikasi OTP</h2>
                <p class="mt-2 text-gray-400">Masukkan kode OTP yang telah dikirim ke email Anda.</p>
            </div>
            @if (session('success'))
                <div class="p-3 text-green-500 rounded bg-green-500/10">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('otp.verify') }}" class="space-y-4">
                @csrf
                <div>
                    <x-input-label for="otp_code" :value="'Kode OTP'" class="text-gray-300" />
                    <x-text-input id="otp_code" type="text" name="otp_code" maxlength="6" required autofocus
                        class="block w-full mt-1 text-xl tracking-widest text-center rounded-lg bg-gray-800/80 border-white/10 focus:border-green-500 focus:ring-green-500" />
                    <x-input-error :messages="$errors->get('otp_code')" class="mt-2" />
                </div>
                <button type="submit"
                    class="w-full px-4 py-3 font-medium text-white transition-colors bg-green-500 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                    Verifikasi
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
