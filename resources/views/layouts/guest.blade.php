<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>RA UMAR MIRZA</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/images/icon.png') }}">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen bg-blue-700 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tombol Kembali -->
            <div class="mb-6">
                <a href="/" class="inline-block px-4 py-2 text-blue-600 bg-white font-semibold rounded hover:bg-blue-700 hover:text-white border border-blue-200 transition">
                    Kembali
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">RA UMAR MIRZA</h2>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
