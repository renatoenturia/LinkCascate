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
                    <p class="mt-1 text-sm text-gray-600">
                        {{ $activeLinks }} ativo(s) de {{ $totalLinks }} no total — ordem da cascata (posição).
                    </p>
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

            <ul class="mt-6 divide-y divide-gray-200 overflow-hidden rounded-md border border-gray-200" role="list">
                @forelse ($links as $link)
                    <li class="flex flex-col gap-3 bg-white p-4 transition hover:bg-gray-50 sm:flex-row sm:items-center sm:justify-between">
                        <div class="min-w-0 flex-1">
                            <p class="flex flex-wrap items-center gap-2 font-medium text-gray-900">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 text-xs text-gray-600" title="Posição na cascata">
                                    {{ $link->position }}
                                </span>
                                <span>{{ $link->title }}</span>
                                @unless ($link->is_active)
                                    <span class="rounded bg-amber-100 px-2 py-0.5 text-xs font-medium text-amber-800">Inativo</span>
                                @endunless
                            </p>
                            <a
                                href="{{ $link->url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-1 block truncate text-sm text-blue-600 hover:underline"
                            >
                                {{ $link->url }}
                            </a>
                        </div>
                        <div class="flex shrink-0 items-start gap-2">
                            @include('links._reorder-buttons', ['link' => $link])
                            <a
                                href="{{ route('links.edit', $link) }}"
                                class="rounded-md border border-gray-300 px-3 py-1.5 text-sm text-gray-700 hover:bg-gray-50"
                            >
                                Editar
                            </a>
                                @include('links._destroy-form', ['link' => $link])
                        </div>
                    </li>
                @empty
                    <li class="p-8 text-center text-sm text-gray-500">
                        Nenhum link ainda.
                        <a href="{{ route('links.create') }}" class="text-blue-600 hover:underline">Criar o primeiro</a>
                    </li>
                @endforelse
            </ul>

            <div class="mt-8 flex flex-wrap gap-3 border-t border-gray-200 pt-6 text-sm">
                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">Dashboard</a>
                <span class="text-gray-300" aria-hidden="true">|</span>
                <a href="{{ route('links.index') }}" class="font-medium text-gray-900" aria-current="page">Listagem (links.index)</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-600 hover:underline">Sair</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
