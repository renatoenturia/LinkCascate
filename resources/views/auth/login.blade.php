<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — {{ config('app.name', 'Laravel') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <div class="w-full max-w-md rounded-lg bg-white p-8 shadow-md">
        <h1 class="mb-6 text-center text-2xl font-semibold text-gray-900">Entrar</h1>

        <form method="POST" action="{{ route('login') }}" class="space-y-4" novalidate>
            @csrf

            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-gray-700">E-mail</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    autofocus
                    autocomplete="email"
                    aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                    @class([
                        'w-full rounded-md border px-3 py-2 focus:outline-none focus:ring-1',
                        'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('email'),
                        'border-gray-300 focus:border-blue-500 focus:ring-blue-500' => ! $errors->has('email'),
                    ])
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium text-gray-700">Senha</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    autocomplete="current-password"
                    aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                    @class([
                        'w-full rounded-md border px-3 py-2 focus:outline-none focus:ring-1',
                        'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('password'),
                        'border-gray-300 focus:border-blue-500 focus:ring-blue-500' => ! $errors->has('password'),
                    ])
                >
                @error('password')
                    <p class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-2">
                <input
                    id="remember"
                    type="checkbox"
                    name="remember"
                    class="rounded border-gray-300"
                >
                <label for="remember" class="text-sm text-gray-700">Lembrar de mim</label>
            </div>

            <button
                type="submit"
                class="w-full rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800"
            >
                Entrar
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Ainda não tem conta?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Cadastre-se</a>
        </p>
        <p class="mt-2 text-center text-sm text-gray-600">
            <a href="{{ url('/') }}" class="text-blue-600 hover:underline">Voltar ao início</a>
        </p>
    </div>
</body>
</html>
