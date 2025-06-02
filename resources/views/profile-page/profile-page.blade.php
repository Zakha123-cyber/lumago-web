{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ auth()->user()->name }} - Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-900">
    <!-- Background Effects -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-radial"></div>
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
        <div class="floating-element float-1"></div>
        <div class="floating-element float-2"></div>
        <div class="floating-element float-3"></div>
    </div>

    <!-- Back Button -->
    <button onclick="history.back()"
        class="fixed top-6 left-6 z-50 back-btn bg-white/10 backdrop-blur-md text-white px-4 py-2 rounded-full">
        <i class="fas fa-arrow-left"></i>
        <span class="ml-2">Kembali</span>
    </button>

    <!-- Main Content -->
    <div class="relative min-h-screen z-10 pt-24 pb-12">
        <div class="container mx-auto px-6">
            <!-- Profile Header -->
            <div class="content-card rounded-2xl p-8 mb-8 fade-in">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <!-- Profile Image -->
                    <div class="relative">
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-green-500/30 hover-lift">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=10B981&color=fff"
                                alt="Profile" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute bottom-0 right-0 bg-green-500 p-2 rounded-full text-white">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="flex-1 text-center md:text-left">
                        <h1 class="text-3xl font-bold text-white mb-2">{{ auth()->user()->name }}</h1>
                        <p class="text-gray-400 mb-4">{{ auth()->user()->role }}</p>
                        <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                            <span class="bg-white/10 px-4 py-2 rounded-full text-sm text-gray-300">
                                <i class="fas fa-envelope mr-2 text-green-400"></i>
                                {{ auth()->user()->email }}
                            </span>
                            <span class="bg-white/10 px-4 py-2 rounded-full text-sm text-gray-300">
                                <i class="fas fa-phone mr-2 text-green-400"></i>
                                {{ auth()->user()->phone }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Transactions -->
                <div class="content-card rounded-xl p-6 hover-lift fade-in delay-1">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-white">Transaksi</h3>
                        <span class="text-green-400"><i class="fas fa-ticket"></i></span>
                    </div>
                    <p class="text-3xl font-bold text-white">{{ auth()->user()->transaksi->count() }}</p>
                    <p class="text-gray-400 text-sm">Total Transaksi</p>
                </div>

                @if (auth()->user()->role === 'admin')
                    <!-- Wisata Management -->
                    <div class="content-card rounded-xl p-6 hover-lift fade-in delay-2">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-white">Tempat Wisata</h3>
                            <span class="text-green-400"><i class="fas fa-map-location-dot"></i></span>
                        </div>
                        <p class="text-3xl font-bold text-white">{{ auth()->user()->tempatWisata->count() }}</p>
                        <p class="text-gray-400 text-sm">Dikelola</p>
                    </div>

                    <!-- Validations -->
                    <div class="content-card rounded-xl p-6 hover-lift fade-in delay-3">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-white">Validasi</h3>
                            <span class="text-green-400"><i class="fas fa-check-circle"></i></span>
                        </div>
                        <p class="text-3xl font-bold text-white">{{ auth()->user()->scanValidasi->count() }}</p>
                        <p class="text-gray-400 text-sm">Total Validasi</p>
                    </div>
                @endif
            </div>

            <!-- Recent Activity -->
            <div class="content-card rounded-2xl p-8 fade-in delay-4">
                <h2 class="text-2xl font-bold text-white mb-6">Aktivitas Terbaru</h2>
                <div class="space-y-4">
                    @forelse(auth()->user()->transaksi()->latest()->take(5)->get() as $transaksi)
                        <div class="bg-white/5 rounded-xl p-4 hover-lift">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-white font-semibold">{{ $transaksi->tempatWisata->nama }}</h4>
                                    <p class="text-sm text-gray-400">{{ $transaksi->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="text-green-400 text-lg font-semibold">
                                    Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-400 text-center py-4">Belum ada aktivitas</p>
                    //@endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Background Styles */
        .bg-gradient-radial {
            background: radial-gradient(circle at center,
                    rgba(15, 23, 42, 0.95) 0%,
                    rgba(2, 6, 23, 0.98) 100%);
        }

        .bg-grid-pattern {
            background-image:
                linear-gradient(rgba(16, 185, 129, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(16, 185, 129, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
        }

        /* Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.8s ease-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .delay-1 {
            animation-delay: 0.2s;
        }

        .delay-2 {
            animation-delay: 0.4s;
        }

        .delay-3 {
            animation-delay: 0.6s;
        }

        .delay-4 {
            animation-delay: 0.8s;
        }

        /* Card Styles */
        .content-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.08);
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            pointer-events: none;
        }

        .float-1 {
            width: 300px;
            height: 300px;
            background: #10b981;
            left: 10%;
            top: 20%;
            animation: float1 15s ease-in-out infinite;
        }

        .float-2 {
            width: 250px;
            height: 250px;
            background: #3b82f6;
            right: 15%;
            top: 30%;
            animation: float2 20s ease-in-out infinite;
        }

        .float-3 {
            width: 200px;
            height: 200px;
            background: #8b5cf6;
            left: 30%;
            bottom: 20%;
            animation: float3 18s ease-in-out infinite;
        }

        @keyframes float1 {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(30px, -30px);
            }
        }

        @keyframes float2 {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-20px, 20px);
            }
        }

        @keyframes float3 {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(25px, 25px);
            }
        }

        @keyframes gridMove {
            0% {
                transform: translateY(-50px);
            }

            100% {
                transform: translateY(0px);
            }
        }
    </style>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fuad - Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-900">
    <!-- Background Effects -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-radial"></div>
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
        <div class="floating-element float-1"></div>
        <div class="floating-element float-2"></div>
        <div class="floating-element float-3"></div>
    </div>

    <!-- Back Button -->
    <button onclick="history.back()"
        class="fixed top-6 left-6 z-50 back-btn bg-white/10 backdrop-blur-md text-white px-4 py-2 rounded-full">
        <i class="fas fa-arrow-left"></i>
        <span class="ml-2">Kembali</span>
    </button>

    <!-- Main Content -->
    <div class="relative min-h-screen z-10 pt-24 pb-12">
        <div class="container mx-auto px-6">
            <!-- Profile Header -->
            <div class="content-card rounded-2xl p-8 mb-8 fade-in">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <!-- Profile Image -->
                    <div class="relative">
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-green-500/30 hover-lift">
                            <img src="https://ui-avatars.com/api/?name=Fuad&background=10B981&color=fff" alt="Profile"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="absolute bottom-0 right-0 bg-green-500 p-2 rounded-full text-white">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="flex-1 text-center md:text-left">
                        <h1 class="text-3xl font-bold text-white mb-2">Fuad</h1>
                        <p class="text-gray-400 mb-4">Admin</p>
                        <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                            <span class="bg-white/10 px-4 py-2 rounded-full text-sm text-gray-300">
                                <i class="fas fa-envelope mr-2 text-green-400"></i>
                                Admin123@gmail.com
                            </span>
                            <span class="bg-white/10 px-4 py-2 rounded-full text-sm text-gray-300">
                                <i class="fas fa-phone mr-2 text-green-400"></i>
                                081727822
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Transactions -->
                <div class="content-card rounded-xl p-6 hover-lift fade-in delay-1">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-white">Transaksi</h3>
                        <span class="text-green-400"><i class="fas fa-ticket"></i></span>
                    </div>
                    <p class="text-3xl font-bold text-white">90</p>
                    <p class="text-gray-400 text-sm">Total Transaksi</p>
                </div>

                {{-- @if (auth()->user()->role === 'admin')
                    <!-- Wisata Management -->
                    <div class="content-card rounded-xl p-6 hover-lift fade-in delay-2">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-white">Tempat Wisata</h3>
                            <span class="text-green-400"><i class="fas fa-map-location-dot"></i></span>
                        </div>
                        <p class="text-3xl font-bold text-white">98</p>
                        <p class="text-gray-400 text-sm">Dikelola</p>
                    </div>

                    <!-- Validations -->
                    <div class="content-card rounded-xl p-6 hover-lift fade-in delay-3">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-white">Validasi</h3>
                            <span class="text-green-400"><i class="fas fa-check-circle"></i></span>
                        </div>
                        <p class="text-3xl font-bold text-white">90</p>
                        <p class="text-gray-400 text-sm">Total Validasi</p>
                    </div>
                @endif --}}
            </div>

            <!-- Recent Activity -->
            <div class="content-card rounded-2xl p-8 fade-in delay-4">
                <h2 class="text-2xl font-bold text-white mb-6">Aktivitas Terbaru</h2>
                <div class="space-y-4">
                    {{-- /@forelse(auth()->user()->transaksi()->latest()->take(5)->get() as $transaksi) --}}
                    <div class="bg-white/5 rounded-xl p-4 hover-lift">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-white font-semibold">Tumpak Sewu</h4>
                                <p class="text-sm text-gray-400">23-23-2029 }}</p>
                            </div>
                            <span class="text-green-400 text-lg font-semibold">
                                Rp 100.000
                            </span>
                        </div>
                    </div>
                    <p class="text-gray-400 text-center py-4">Belum ada aktivitas</p>

                </div>
            </div>
        </div>
    </div>

    <style>
        /* Background Styles */
        .bg-gradient-radial {
            background: radial-gradient(circle at center,
                    rgba(15, 23, 42, 0.95) 0%,
                    rgba(2, 6, 23, 0.98) 100%);
        }

        .bg-grid-pattern {
            background-image:
                linear-gradient(rgba(16, 185, 129, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(16, 185, 129, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
        }

        /* Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.8s ease-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .delay-1 {
            animation-delay: 0.2s;
        }

        .delay-2 {
            animation-delay: 0.4s;
        }

        .delay-3 {
            animation-delay: 0.6s;
        }

        .delay-4 {
            animation-delay: 0.8s;
        }

        /* Card Styles */
        .content-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.08);
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            pointer-events: none;
        }

        .float-1 {
            width: 300px;
            height: 300px;
            background: #10b981;
            left: 10%;
            top: 20%;
            animation: float1 15s ease-in-out infinite;
        }

        .float-2 {
            width: 250px;
            height: 250px;
            background: #3b82f6;
            right: 15%;
            top: 30%;
            animation: float2 20s ease-in-out infinite;
        }

        .float-3 {
            width: 200px;
            height: 200px;
            background: #8b5cf6;
            left: 30%;
            bottom: 20%;
            animation: float3 18s ease-in-out infinite;
        }

        @keyframes float1 {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(30px, -30px);
            }
        }

        @keyframes float2 {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-20px, 20px);
            }
        }

        @keyframes float3 {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(25px, 25px);
            }
        }

        @keyframes gridMove {
            0% {
                transform: translateY(-50px);
            }

            100% {
                transform: translateY(0px);
            }
        }
    </style>
</body>

</html>
