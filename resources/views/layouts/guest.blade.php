<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ABIL SHOP') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-orange-50 via-white to-red-50">
        <div class="mb-6">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16.5 6a3 3 0 11-6 0 3 3 0 016 0zM3 20a6 6 0 0112 0M15 20a6 6 0 016-4.472M13.5 6a3 3 0 116 0" />
                </svg>
                <span class="text-2xl font-extrabold tracking-tight">
                    <span class="text-orange-600">ABIL</span><span class="text-stone-800">SHOP</span>
                </span>
            </a>
        </div>

        <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-xl overflow-hidden sm:rounded-2xl border border-stone-100">
            {{ $slot }}
        </div>
    </div>
</body>
</html>