@extends('layouts.app')

@section('title', 'Meu perfil — '.config('app.name'))

@section('content')
    <x-card title="Perfil público" body-class="max-w-xl">
        <x-slot name="header">
            @if ($user->handler)
                <x-alert variant="info" class="mt-2 py-2">
                    <span>
                        Prévia:
                        <a href="{{ route('biolink.show', $user) }}" class="link font-medium" target="_blank" rel="noopener noreferrer">
                            {{ route('biolink.show', $user) }}
                        </a>
                    </span>
                </x-alert>
            @endif
        </x-slot>

        <p class="text-sm opacity-80">
            Nome, resumo e identificador na sua bio. Links em
            <a href="{{ route('links.index') }}" class="link link-primary">Meus links</a>.
        </p>

        <x-form :action="route('profile.store')" multipart class="mt-4">
            <x-file
                label="Foto de perfil"
                name="avatar"
                accept="image/jpeg,image/png,image/webp"
                :preview-url="$user->avatarUrl()"
                :preview-alt="'Foto de '.$user->name"
                help="JPG, PNG ou WebP — até 2 MB."
            />

            <x-input label="Nome" name="name" :value="$user->name" required autofocus />

            <x-input
                label="Identificador"
                name="handler"
                :value="$user->handler ? '@'.$user->handler : ''"
                :error-keys="['handler', 'handler_slug']"
                required
                placeholder="@seu_nome"
                autocomplete="username"
                spellcheck="false"
                class="font-mono"
            >
                <x-slot name="hint">Começa com @ — letras, números, _ e -</x-slot>
            </x-input>

            <x-textarea label="Biografia / resumo" name="bio" :value="$user->bio" maxlength="500" placeholder="Uma frase sobre você." />

            <x-slot name="actions">
                <x-button type="submit">Salvar perfil</x-button>
                <x-button :href="route('dashboard')" variant="ghost">Dashboard</x-button>
            </x-slot>
        </x-form>
    </x-card>
@endsection
