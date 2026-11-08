<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $user->name }} — {{ config('app.name') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-base-200 px-4 py-10" data-theme="corporate">
    <div class="mx-auto max-w-md text-center">
        @if ($user->avatarUrl())
            <img
                src="{{ $user->avatarUrl() }}"
                alt="Foto de {{ $user->name }}"
                class="mx-auto h-24 w-24 rounded-full border border-gray-200 object-cover shadow-sm"
            >
        @endif
        <h1 class="mt-4 text-2xl font-semibold text-gray-900">{{ $user->name }}</h1>
        @if ($user->bio)
            <p class="mt-3 text-sm leading-relaxed text-gray-600">{{ $user->bio }}</p>
        @endif
        <p class="mt-1 text-xs text-gray-400">@{{ $user->handler }}</p>

        <ul class="mt-8 space-y-3" role="list">
            @forelse ($links as $link)
                <li>
                    <a
                        href="{{ $link->url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn btn-neutral btn-block"
                    >
                        {{ $link->title }}
                    </a>
                </li>
            @empty
                <li class="text-sm text-gray-500">Nenhum link público ainda.</li>
            @endforelse
        </ul>
    </div>
</body>
</html>
