<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro — {{ config('app.name', 'Laravel') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <div class="w-full max-w-md rounded-lg bg-white p-8 shadow-md">
        <h1 class="mb-2 text-center text-2xl font-semibold text-gray-900">Criar conta</h1>
        <p class="mb-6 text-center text-sm text-gray-600">
            A senha deve ter no mínimo 8 caracteres, com letras maiúsculas, minúsculas e números.
        </p>

        <form method="POST" action="{{ route('register') }}" class="space-y-4" novalidate>
            @csrf

            <div>
                <label for="name" class="mb-1 block text-sm font-medium text-gray-700">Nome</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    autofocus
                    autocomplete="name"
                    aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
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
                <label for="email" class="mb-1 block text-sm font-medium text-gray-700">E-mail</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
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
                <label for="email_confirmation" class="mb-1 block text-sm font-medium text-gray-700">Confirmar e-mail</label>
                <input
                    id="email_confirmation"
                    type="email"
                    name="email_confirmation"
                    value="{{ old('email_confirmation') }}"
                    autocomplete="email"
                    aria-invalid="{{ $errors->has('email_confirmation') ? 'true' : 'false' }}"
                    @class([
                        'w-full rounded-md border px-3 py-2 focus:outline-none focus:ring-1',
                        'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('email_confirmation'),
                        'border-gray-300 focus:border-blue-500 focus:ring-blue-500' => ! $errors->has('email_confirmation'),
                    ])
                >
                @error('email_confirmation')
                    <p class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium text-gray-700">Senha</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    autocomplete="new-password"
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

            <div>
                <label for="password_confirmation" class="mb-1 block text-sm font-medium text-gray-700">Confirmar senha</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    autocomplete="new-password"
                    aria-invalid="{{ $errors->has('password_confirmation') ? 'true' : 'false' }}"
                    @class([
                        'w-full rounded-md border px-3 py-2 focus:outline-none focus:ring-1',
                        'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('password_confirmation'),
                        'border-gray-300 focus:border-blue-500 focus:ring-blue-500' => ! $errors->has('password_confirmation'),
                    ])
                >
                @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800"
            >
                Cadastrar
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Já tem conta?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Entrar</a>
        </p>
    </div>
</body>
</html>
