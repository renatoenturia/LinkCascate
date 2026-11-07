<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Novo link — {{ config('app.name') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-gray-100 p-4 md:p-6">
    <div class="mx-auto max-w-lg rounded-lg bg-white p-6 shadow-md md:p-8">
        <h1 class="text-2xl font-semibold text-gray-900">Novo link</h1>
        <p class="mt-1 text-sm text-gray-600">Adicione um item à sua cascata de bio links.</p>

        <form method="POST" action="{{ route('links.store') }}" class="mt-6 space-y-6" novalidate>
            @csrf
            @include('links._form')

            <div class="flex flex-wrap gap-3">
                <button
                    type="submit"
                    class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800"
                >
                    Salvar
                </button>
                <a href="{{ route('links.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</body>
</html>
