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

    <!-- Back Buttons -->
    <div class="fixed z-50 flex gap-4 top-6 left-6">
        <a href="{{ route('landing.index') }}"
            class="flex items-center px-4 py-2 text-white transition-all duration-300 rounded-full bg-white/10 backdrop-blur-md hover:bg-white/20">
            <i class="mr-2 fas fa-home"></i>
            <span>Beranda</span>
        </a>
    </div>

    <!-- Action Buttons -->
    <div class="fixed z-50 flex gap-4 top-6 right-6">
        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center px-4 py-2 text-white transition-all duration-300 rounded-full bg-red-500/20 backdrop-blur-md hover:bg-red-500/30">
                <i class="mr-2 fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 min-h-screen py-24">
        <div class="container px-6 mx-auto max-w-7xl">
            <div class="grid gap-8">
                <!-- Profile Header -->
                <div class="p-8 transition-all duration-300 content-card rounded-2xl fade-in hover:bg-white/10">
                    <div class="flex flex-col gap-8 lg:flex-row">
                        <!-- Left Section: Profile Image & Info -->
                        <div class="flex flex-col items-center gap-8 md:flex-row lg:w-1/2">
                            <!-- Profile Image -->
                            <div class="relative">
                                <div
                                    class="w-32 h-32 overflow-hidden border-4 rounded-full border-green-500/30 hover-lift">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=10B981&color=fff"
                                        alt="Profile" class="object-cover w-full h-full">
                                </div>
                                <div
                                    class="absolute bottom-0 right-0 p-2 text-white transition-all duration-300 bg-green-500 rounded-full cursor-pointer hover:bg-green-600">
                                    <i class="fas fa-camera"></i>
                                </div>
                            </div>

                            <!-- User Info -->
                            <div class="flex-1 text-center md:text-left">
                                <h1 class="mb-2 text-3xl font-bold text-white">{{ $user->name }}</h1>
                                <p class="mb-4 text-gray-400">{{ ucfirst($user->role) }}</p>
                                <div class="flex flex-wrap items-center justify-center gap-4 md:justify-start">
                                    <span
                                        class="inline-flex items-center px-4 py-2 text-sm text-gray-300 transition-all duration-300 rounded-full bg-white/10 hover:bg-white/20">
                                        <i class="mr-2 text-green-400 fas fa-envelope"></i>
                                        {{ $user->email }}
                                    </span>
                                    <span
                                        class="inline-flex items-center px-4 py-2 text-sm text-gray-300 transition-all duration-300 rounded-full bg-white/10 hover:bg-white/20">
                                        <i class="mr-2 text-green-400 fas fa-phone"></i>
                                        {{ $user->phone }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Right Section: Stats Grid -->
                        <div class="pl-8 border-l lg:w-1/2 border-white/10">
                            <div
                                class="grid grid-cols-1 gap-4 md:grid-cols-{{ $user->role === 'adminwisata' ? '3' : '1' }}">
                                <!-- Transactions -->
                                <div
                                    class="p-6 transition-all duration-300 content-card rounded-xl hover-lift fade-in delay-1">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-white">Transaksi</h3>
                                        <span class="p-3 text-green-400 rounded-full bg-green-500/10">
                                            <i class="fas fa-ticket"></i>
                                        </span>
                                    </div>
                                    <p class="text-3xl font-bold text-white">{{ $totalTransaksi }}</p>
                                    <p class="text-sm text-gray-400">Total Transaksi</p>
                                </div>

                                @if ($user->role === 'adminwisata')
                                    <!-- Wisata Management -->
                                    <div
                                        class="p-6 transition-all duration-300 content-card rounded-xl hover-lift fade-in delay-2">
                                        <div class="flex items-center justify-between mb-4">
                                            <h3 class="text-lg font-semibold text-white">Tempat Wisata</h3>
                                            <span class="p-3 text-green-400 rounded-full bg-green-500/10">
                                                <i class="fas fa-map-location-dot"></i>
                                            </span>
                                        </div>
                                        <p class="text-3xl font-bold text-white">{{ $totalTempatWisata }}</p>
                                        <p class="text-sm text-gray-400">Dikelola</p>
                                    </div>

                                    <!-- Validations -->
                                    <div
                                        class="p-6 transition-all duration-300 content-card rounded-xl hover-lift fade-in delay-3">
                                        <div class="flex items-center justify-between mb-4">
                                            <h3 class="text-lg font-semibold text-white">Validasi</h3>
                                            <span class="p-3 text-green-400 rounded-full bg-green-500/10">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </div>
                                        <p class="text-3xl font-bold text-white">{{ $totalValidasi }}</p>
                                        <p class="text-sm text-gray-400">Total Validasi</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <x-recent-activity :recentTransactions="$recentTransactions" />
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
            position: relative;
            overflow: hidden;
        }

        .content-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, 0.05),
                    transparent);
            transition: 0.5s;
        }

        .content-card:hover::before {
            left: 100%;
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

        /* New Animations */
        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        /* Smooth Scrollbar for Dropdown */
        .overflow-y-auto {
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
        }

        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: transparent;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }
    </style>
</body>

</html>
