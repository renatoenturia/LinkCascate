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
            <a href="{{ route('dashboard') }}" class="btn btn-ghost text-xl">{{ config('app.name') }}</a>
        </div>
        <nav class="flex-none">
            <ul class="menu menu-horizontal items-center gap-1 px-1">
                <li><a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) active @endif">Dashboard</a></li>
                <li><a href="{{ route('profile.index') }}" class="@if(request()->routeIs('profile.*')) active @endif">Perfil</a></li>
                <li><a href="{{ route('links.index') }}" class="@if(request()->routeIs('links.*')) active @endif">Links</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline btn-sm">Sair</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <main class="container mx-auto max-w-4xl p-4 md:p-6">
        @if (session('status'))
            <div role="alert" class="alert alert-success mb-4">
                <span>{{ session('status') }}</span>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
