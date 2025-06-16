<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .grid-pattern {
            position: absolute;
            width: 200%;
            height: 200%;
            background-image:
                linear-gradient(rgba(16, 185, 129, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(16, 185, 129, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
            opacity: 0.3;
            transform: rotate(45deg);
        }

        .floating-element {
            position: absolute;
            border-radius: 50%;
            filter: blur(50px);
            opacity: 0.05;
            z-index: 1;
        }

        .float-1 {
            width: 300px;
            height: 300px;
            background: #10b981;
            animation: float1 15s ease-in-out infinite;
        }

        .float-2 {
            width: 200px;
            height: 200px;
            background: #3b82f6;
            animation: float2 20s ease-in-out infinite;
        }

        @keyframes gridMove {
            0% {
                transform: translateY(-50%) rotate(45deg);
            }

            100% {
                transform: translateY(0%) rotate(45deg);
            }
        }

        @keyframes float1 {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(100px, 50px);
            }
        }

        @keyframes float2 {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-100px, -50px);
            }
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-100 bg-gray-900">
    <!-- Animated Background -->
    <div class="fixed inset-0 z-[-1] bg-[#0A0F1C] overflow-hidden">
        <!-- Grid Pattern -->
        <div class="grid-pattern"></div>

        <!-- Floating Elements -->
        <div class="floating-element float-1 left-[5%] top-[20%]"></div>
        <div class="floating-element float-2 right-[10%] bottom-[30%]"></div>

        <!-- Radial Pattern -->
        <div
            class="absolute inset-0 bg-[radial-gradient(#222_1px,transparent_1px)] [background-size:16px_16px] [mask-image:radial-gradient(ellipse_50%_50%_at_50%_50%,#000_70%,transparent_100%)]">
        </div>
    </div>

    {{ $slot }}
</body>

</html>
