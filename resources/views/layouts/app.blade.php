<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'UEP Feedback Form')</title>

    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('uep_logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js CDN (for x-data directives) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 overflow-x-hidden">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-uep-blue text-white shadow-md">
            <div class="container mx-auto px-4 py-3 flex items-center gap-3">
                <img src="{{ asset('uep_logo.png') }}" alt="UEP Logo" class="w-12 h-12 object-contain">
                <h1 class="text-2xl font-times font-bold leading-tight">UEP Feedback Form</h1>
            </div>
            <div class="bg-uep-yellow h-1 w-full"></div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-6 max-w-md">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>

