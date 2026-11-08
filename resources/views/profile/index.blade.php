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
                <a href="{{ route('biolink.show', $user) }}" class="font-medium text-blue-600 hover:underline" target="_blank" rel="noopener noreferrer">
                    {{ route('biolink.show', $user) }}
                </a>
            </p>
        @endif

        <form method="POST" action="{{ route('profile.store') }}" class="mt-6 space-y-5" enctype="multipart/form-data" novalidate>
            @csrf

            <div>
                <span class="mb-1 block text-sm font-medium text-gray-700">Foto de perfil</span>
                <div class="flex items-center gap-4">
                    @if ($user->avatarUrl())
                        <img
                            src="{{ $user->avatarUrl() }}"
                            alt="Foto atual de {{ $user->name }}"
                            class="h-20 w-20 rounded-full border border-gray-200 object-cover"
                        >
                    @else
                        <div class="flex h-20 w-20 items-center justify-center rounded-full border border-dashed border-gray-300 bg-gray-50 text-xs text-gray-400">
                            Sem foto
                        </div>
                    @endif
                    <div class="min-w-0 flex-1">
                        <input
                            id="avatar"
                            type="file"
                            name="avatar"
                            accept="image/jpeg,image/png,image/webp"
                            @class([
                                'block w-full text-sm text-gray-600 file:mr-3 file:rounded-md file:border-0 file:bg-gray-100 file:px-3 file:py-2 file:text-sm file:font-medium file:text-gray-800 hover:file:bg-gray-200',
                            ])
                        >
                        <p class="mt-1 text-xs text-gray-500">JPG, PNG ou WebP — até 2 MB.</p>
                    </div>
                </div>
                @error('avatar')
                    <p class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
                @enderror
            </div>

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
                <p class="mb-2 text-xs text-gray-500">Começa com @, sem espaços — letras, números, _ e -</p>
                <input
                    id="handler"
                    type="text"
                    name="handler"
                    value="{{ old('handler', $user->handler ? '@'.$user->handler : '') }}"
                    required
                    placeholder="@seu_nome"
                    autocomplete="username"
                    spellcheck="false"
                    @class([
                        'w-full rounded-md border px-3 py-2 font-mono text-sm focus:outline-none focus:ring-1',
                        'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('handler') || $errors->has('handler_slug'),
                        'border-gray-300 focus:border-blue-500 focus:ring-blue-500' => ! $errors->has('handler') && ! $errors->has('handler_slug'),
                    ])
                >
                @error('handler')
                    <p class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
                @enderror
                @error('handler_slug')
                    <p class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
                @enderror
                @if ($user->handler)
                    <p class="mt-2 text-xs text-gray-500">
                        URL: <span class="font-mono">{{ url('/p/'.$user->handler) }}</span>
                    </p>
                @endif
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
