<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar link — {{ config('app.name') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-gray-100 p-4 md:p-6">
    <div class="mx-auto max-w-lg rounded-lg bg-white p-6 shadow-md md:p-8">
        <h1 class="text-2xl font-semibold text-gray-900">Editar link</h1>
        <p class="mt-1 text-sm text-gray-600">Atualize título, URL, posição e visibilidade.</p>

        <form method="POST" action="{{ route('links.update', $link) }}" class="mt-6 space-y-6" novalidate>
            @csrf
            @method('PUT')
            @include('links._form', ['link' => $link])

            <div class="flex flex-wrap gap-3">
                <button
                    type="submit"
                    class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800"
                >
                    Atualizar
                </button>
                <a href="{{ route('links.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    Voltar
                </a>
            </div>
        </form>

        @can('delete', $link)
            <section class="mt-10 border-t border-red-100 pt-6" aria-labelledby="danger-zone-heading">
                <h2 id="danger-zone-heading" class="text-sm font-semibold text-red-800">Zona de perigo</h2>
                <p class="mt-1 text-sm text-gray-600">Remove este link permanentemente da sua cascata.</p>
                <div class="mt-4">
                    @include('links._destroy-form', [
                        'link' => $link,
                        'buttonClass' => 'rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700',
                        'buttonLabel' => 'Excluir link',
                    ])
                </div>
            </section>
        @endcan
    </div>
</body>
</html>
