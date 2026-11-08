<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meu perfil — {{ config('app.name') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-gray-100 p-4 md:p-6">
    <div class="mx-auto max-w-2xl rounded-lg bg-white p-6 shadow-md md:p-8">
        <h1 class="text-2xl font-semibold text-gray-900">Perfil público</h1>
        <p class="mt-1 text-sm text-gray-600">
            Nome, resumo e handler aparecem na sua página de bio. Os links são gerenciados em
            <a href="{{ route('links.index') }}" class="text-blue-600 hover:underline">Meus links</a>
            (criar, editar e reordenar).
        </p>

        @if (session('status'))
            <p class="mt-4 rounded-md bg-green-50 p-3 text-sm text-green-800" role="status">
                {{ session('status') }}
            </p>
        @endif

        @if ($user->handler)
            <p class="mt-4 text-sm text-gray-600">
                Prévia:
                <a href="{{ route('profile.show', $user->handler) }}" class="font-medium text-blue-600 hover:underline" target="_blank" rel="noopener noreferrer">
                    {{ url('/p/'.$user->handler) }}
                </a>
            </p>
        @endif

        <form method="POST" action="{{ route('profile.store') }}" class="mt-6 space-y-5" novalidate>
            @csrf

            <div>
                <label for="name" class="mb-1 block text-sm font-medium text-gray-700">Nome</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    @class([
                        'w-full rounded-md border px-3 py-2 focus:outline-none focus:ring-1',
                        'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('name'),
                        'border-gray-300 focus:border-blue-500 focus:ring-blue-500' => ! $errors->has('name'),
                    ])
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="handler" class="mb-1 block text-sm font-medium text-gray-700">Handler</label>
                <div class="flex rounded-md shadow-sm">
                    <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">/p/</span>
                    <input
                        id="handler"
                        type="text"
                        name="handler"
                        value="{{ old('handler', $user->handler) }}"
                        required
                        pattern="[a-zA-Z0-9_-]+"
                        autocomplete="username"
                        @class([
                            'w-full rounded-r-md border px-3 py-2 focus:outline-none focus:ring-1',
                            'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('handler'),
                            'border-gray-300 focus:border-blue-500 focus:ring-blue-500' => ! $errors->has('handler'),
                        ])
                    >
                </div>
                @error('handler')
                    <p class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="bio" class="mb-1 block text-sm font-medium text-gray-700">Biografia / resumo</label>
                <textarea
                    id="bio"
                    name="bio"
                    rows="4"
                    maxlength="500"
                    placeholder="Uma frase sobre você ou seus projetos."
                    @class([
                        'w-full rounded-md border px-3 py-2 focus:outline-none focus:ring-1',
                        'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('bio'),
                        'border-gray-300 focus:border-blue-500 focus:ring-blue-500' => ! $errors->has('bio'),
                    ])
                >{{ old('bio', $user->bio) }}</textarea>
                @error('bio')
                    <p class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-wrap gap-3 pt-2">
                <button type="submit" class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800">
                    Salvar perfil
                </button>
                <a href="{{ route('dashboard') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    Dashboard
                </a>
            </div>
        </form>
    </div>
</body>
</html>
