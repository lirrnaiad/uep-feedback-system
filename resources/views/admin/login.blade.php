<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - UEP Feedback System</title>

    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('uep_logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full">
            <!-- Logo and Title -->
            <div class="text-center mb-8">
                <img src="{{ asset('uep_logo.png') }}" alt="UEP Logo" class="w-20 h-20 mx-auto mb-4">
                <h1 class="text-3xl font-times font-bold text-uep-blue">Admin Panel</h1>
                <p class="text-gray-600 mt-2">UEP Feedback System</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Sign In</h2>

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.authenticate') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Admin Password
                        </label>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               required
                               autofocus
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-uep-blue focus:border-transparent">
                    </div>

                    <button type="submit" 
                            class="w-full bg-uep-blue text-white py-3 px-4 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                        Login
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <a href="{{ route('feedback.create') }}" 
                       class="text-sm text-uep-blue hover:underline">
                        ← Back to Feedback Form
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
