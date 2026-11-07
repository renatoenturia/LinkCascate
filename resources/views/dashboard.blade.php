<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — {{ config('app.name', 'Laravel') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-gray-100 p-6">
    <div class="mx-auto max-w-2xl rounded-lg bg-white p-8 shadow-md">
        <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
        <p class="mt-2 text-gray-600">
            Olá, <span class="font-medium text-gray-900">{{ auth()->user()->name }}</span>.
        </p>

        <div class="mt-8 flex flex-wrap gap-4">
            <a
                href="{{ route('links.index') }}"
                class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800"
            >
                Meus links
            </a>
            <a
                href="{{ route('home') }}"
                class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                Início
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800"
                >
                    Sair
                </button>
            </form>
        </div>
    </div>
</body>
</html>
