<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-900" x-data="{
    sidebarOpen: window.innerWidth >= 640,
    init() {
        window.addEventListener('resize', () => {
            this.sidebarOpen = window.innerWidth >= 640 ? true : this.sidebarOpen
        })
    }
}">
    <!-- Mobile Toggle Button - Hidden when sidebar is open -->
    <button @click="sidebarOpen = !sidebarOpen"
        class="fixed z-50 p-3 text-2xl text-green-400 transition-opacity duration-300 bg-gray-900 rounded-full shadow-lg left-4 top-4 sm:hidden focus:outline-none"
        :class="{ 'opacity-0 pointer-events-none': sidebarOpen }">
        <i class="fa-solid fa-bars"></i>
    </button>

    <!-- Backdrop -->
    <div x-cloak x-show="sidebarOpen && window.innerWidth < 640" @click="sidebarOpen = false"
        class="fixed inset-0 z-30 bg-gray-900/50 sm:hidden backdrop-blur-sm">
    </div>

    <!-- Your existing sidebar component -->
    <x-sidebar-admin />

    <!-- Main Content -->
    <main class="px-4 py-5 transition-all duration-300 sm:ml-64">
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>
