<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meus links — {{ config('app.name') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-gray-100 p-4 md:p-6">
    <div class="mx-auto max-w-3xl space-y-6">
        <div class="rounded-lg bg-white p-6 shadow-md md:p-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Meus links</h1>
                    <p class="mt-1 text-sm text-gray-600">Organize os links em cascata da sua bio.</p>
                </div>
                <a
                    href="{{ route('links.create') }}"
                    class="inline-flex justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800"
                >
                    Novo link
                </a>
            </div>

            @if (session('status'))
                <p class="mt-4 rounded-md bg-green-50 p-3 text-sm text-green-800" role="status">
                    {{ session('status') }}
                </p>
            @endif

            @if ($links->isEmpty())
                <p class="mt-8 text-center text-sm text-gray-500">
                    Nenhum link ainda.
                    <a href="{{ route('links.create') }}" class="text-blue-600 hover:underline">Criar o primeiro</a>
                </p>
            @else
                <ul class="mt-6 divide-y divide-gray-200 border border-gray-200 rounded-md">
                    @foreach ($links as $link)
                        <li class="flex flex-col gap-3 p-4 sm:flex-row sm:items-center sm:justify-between">
                            <div class="min-w-0 flex-1">
                                <p class="flex flex-wrap items-center gap-2 font-medium text-gray-900">
                                    <span>{{ $link->title }}</span>
                                    @unless ($link->is_active)
                                        <span class="rounded bg-gray-200 px-2 py-0.5 text-xs text-gray-600">Inativo</span>
                                    @endunless
                                </p>
                                <p class="truncate text-sm text-gray-500">{{ $link->url }}</p>
                                <p class="text-xs text-gray-400">Posição {{ $link->position }}</p>
                            </div>
                            <div class="flex shrink-0 gap-2">
                                <a
                                    href="{{ route('links.edit', $link) }}"
                                    class="rounded-md border border-gray-300 px-3 py-1.5 text-sm text-gray-700 hover:bg-gray-50"
                                >
                                    Editar
                                </a>
                                <form method="POST" action="{{ route('links.destroy', $link) }}" onsubmit="return confirm('Remover este link?');">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="rounded-md border border-red-200 px-3 py-1.5 text-sm text-red-700 hover:bg-red-50"
                                    >
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif

            <div class="mt-8 flex flex-wrap gap-3 border-t border-gray-200 pt-6">
                <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:underline">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-gray-600 hover:underline">Sair</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
