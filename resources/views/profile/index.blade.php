@extends('layouts.app')

@section('title', 'Meu perfil — '.config('app.name'))

@section('content')
    <x-ui.page-card title="Perfil público" body-class="max-w-xl">
        <x-slot name="header">
            @if ($user->handler)
                <div class="alert alert-info mt-2 py-2">
                    <span>
                        Prévia:
                        <a href="{{ route('biolink.show', $user) }}" class="link font-medium" target="_blank" rel="noopener noreferrer">
                            {{ route('biolink.show', $user) }}
                        </a>
                    </span>
                </div>
            @endif
        </x-slot>

        <p class="text-sm opacity-80">
            Nome, resumo e handler na sua bio. Links em
            <a href="{{ route('links.index') }}" class="link link-primary">Meus links</a>.
        </p>

        <form method="POST" action="{{ route('profile.store') }}" class="mt-4 space-y-4" enctype="multipart/form-data" novalidate>
            @csrf

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Foto de perfil</legend>
                <div class="flex items-center gap-4">
                    @if ($user->avatarUrl())
                        <div class="avatar">
                            <div class="w-20 rounded-full">
                                <img src="{{ $user->avatarUrl() }}" alt="Foto de {{ $user->name }}">
                            </div>
                        </div>
                    @else
                        <div class="avatar avatar-placeholder">
                            <div class="bg-neutral text-neutral-content w-20 rounded-full">
                                <span class="text-xs">Sem foto</span>
                            </div>
                        </div>
                    @endif
                    <input id="avatar" type="file" name="avatar" accept="image/jpeg,image/png,image/webp"
                        class="file-input file-input-bordered w-full max-w-xs @error('avatar') file-input-error @enderror">
                </div>
                <p class="text-xs opacity-70">JPG, PNG ou WebP — até 2 MB.</p>
                @error('avatar')<p class="text-error text-sm">{{ $message }}</p>@enderror
            </fieldset>

            <x-form.input label="Nome" name="name" :value="$user->name" required autofocus />

            <x-form.input
                label="Handler"
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
            </x-form.input>

            <x-form.textarea label="Biografia / resumo" name="bio" :value="$user->bio" maxlength="500" placeholder="Uma frase sobre você." />

            <x-form.actions submit-label="Salvar perfil">
                <a href="{{ route('dashboard') }}" class="btn btn-ghost">Dashboard</a>
            </x-form.actions>
        </form>
    </x-ui.page-card>
@endsection
