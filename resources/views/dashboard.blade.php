@extends('layouts.app')

@section('title', 'Dashboard — '.config('app.name'))

@section('content')
    <x-card title="Dashboard">
        <p class="text-base-content/80">
            Olá, <span class="font-semibold">{{ auth()->user()->name }}</span> — gerencie sua bio em cascata.
        </p>

        <x-slot name="header">
            @if (auth()->user()->handler)
                <x-alert variant="info" class="mt-2">
                    <span>
                        Sua página pública:
                        <a href="{{ route('biolink.show', auth()->user()) }}" class="link font-medium" target="_blank" rel="noopener noreferrer">
                            {{ route('biolink.show', auth()->user()) }}
                        </a>
                    </span>
                </x-alert>
            @else
                <x-alert variant="warning" class="mt-2">
                    <span>Defina seu <a href="{{ route('profile.index') }}" class="link">identificador no perfil</a> para publicar sua bio.</span>
                </x-alert>
            @endif
        </x-slot>

        <div class="divider">Atalhos</div>

        <div class="grid gap-3 sm:grid-cols-2">
            <x-card bordered class="bg-base-100 shadow-none transition-colors hover:bg-base-200">
                <h2 class="card-title text-lg">Meu perfil</h2>
                <p class="text-sm opacity-80">Nome, bio, identificador e foto.</p>
                <x-slot name="actions">
                    <x-button :href="route('profile.index')" size="sm">Abrir</x-button>
                </x-slot>
            </x-card>
            <x-card bordered class="bg-base-100 shadow-none transition-colors hover:bg-base-200">
                <h2 class="card-title text-lg">Meus links</h2>
                <p class="text-sm opacity-80">Criar, editar e reordenar a cascata.</p>
                <x-slot name="actions">
                    <x-button :href="route('links.index')" variant="secondary" size="sm">Abrir</x-button>
                </x-slot>
            </x-card>
        </div>

        <x-button :href="route('home')" variant="ghost" size="sm" class="mt-4">Voltar ao início</x-button>
    </x-card>
@endsection
