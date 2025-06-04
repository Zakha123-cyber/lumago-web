<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LumaGO') }}</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="flex flex-col min-h-screen text-gray-800 bg-gray-50">

    {{-- Navbar --}}
    <x-navbar></x-navbar>
    {{-- Content --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-footer></x-footer>

    {{-- Scripts --}}
    @stack('script')
</body>

</html>
