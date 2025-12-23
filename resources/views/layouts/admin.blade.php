<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'UEP Admin Panel')</title>

    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('uep_logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-uep-blue text-white flex-shrink-0">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-8">
                    <img src="{{ asset('uep_logo.png') }}" alt="UEP Logo" class="w-10 h-10 object-contain">
                    <h1 class="text-xl font-times font-bold">UEP Admin</h1>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="block px-4 py-2 rounded text-white hover:bg-blue-800 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-800' : '' }}">
                        📊 Dashboard
                    </a>
                    <a href="{{ route('admin.analytics') }}" 
                       class="block px-4 py-2 rounded text-white hover:bg-blue-800 transition {{ request()->routeIs('admin.analytics') ? 'bg-blue-800' : '' }}">
                        📈 Analytics
                    </a>
                    <a href="{{ route('admin.entries') }}" 
                       class="block px-4 py-2 rounded text-white hover:bg-blue-800 transition {{ request()->routeIs('admin.entries*') ? 'bg-blue-800' : '' }}">
                        📋 Feedback Entries
                    </a>
                    <a href="{{ route('admin.suggestions') }}" 
                       class="block px-4 py-2 rounded text-white hover:bg-blue-800 transition {{ request()->routeIs('admin.suggestions') ? 'bg-blue-800' : '' }}">
                        💬 Suggestions
                    </a>
                    
                    <div class="pt-4 mt-4 border-t border-white border-opacity-20">
                        <a href="{{ route('feedback.create') }}" 
                           class="block px-4 py-2 rounded text-white hover:bg-blue-800 transition"
                           target="_blank">
                            🔗 View Public Form
                        </a>
                        <form method="POST" action="{{ route('admin.logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" 
                                    class="w-full text-left px-4 py-2 rounded text-white hover:bg-blue-800 transition">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4">
                    <h2 class="text-2xl font-times font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                </div>
                <div class="bg-uep-yellow h-1 w-full"></div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 p-6 overflow-y-auto">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if(isset($error))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                        <span class="block sm:inline">{{ $error }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
