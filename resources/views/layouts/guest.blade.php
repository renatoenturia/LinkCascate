<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="corporate">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-base-200">
    <header class="navbar bg-base-100 shadow-sm">
        <div class="flex-1">
            <a href="{{ route('home') }}" class="btn btn-ghost text-xl">{{ config('app.name') }}</a>
        </div>
        <div class="flex-none gap-1">
            @if (Route::has('login'))
                <x-button :href="route('login')" variant="ghost" size="sm">Entrar</x-button>
            @endif
            @if (Route::has('register'))
                <x-button :href="route('register')" size="sm">Cadastre-se</x-button>
            @endif
        </div>
    </header>

    <main class="flex min-h-[calc(100vh-4rem)] items-center justify-center p-4">
        @yield('content')
    </main>
</body>
</html>
