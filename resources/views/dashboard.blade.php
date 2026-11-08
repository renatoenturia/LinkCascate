@extends('layouts.app')

@section('title', 'Dashboard — '.config('app.name'))

@section('content')
    @php
        $user = auth()->user();
        $greeting = 'Olá, '.$user->name.' — gerencie sua bio em cascata.';
    @endphp

    <x-card title="Dashboard" :description="$greeting">
        <x-slot name="header">
            @if ($user->handler)
                <x-alert variant="info" class="mt-1">
                    <span class="flex flex-col gap-2 sm:flex-row sm:flex-wrap sm:items-center">
                        <span class="min-w-0">
                            Sua página pública:
                            <a href="{{ route('biolink.show', $user) }}" class="link break-all font-medium" target="_blank" rel="noopener noreferrer">
                                {{ route('biolink.show', $user) }}
                            </a>
                        </span>
                        <x-button
                            :href="route('biolink.show', $user)"
                            variant="ghost"
                            size="xs"
                            icon="external"
                            class="shrink-0"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            Ver bio
                        </x-button>
                    </span>
                </x-alert>
            @else
                <x-alert variant="warning" class="mt-1">
                    <span>Defina seu <a href="{{ route('profile.index') }}" class="link">identificador no perfil</a> para publicar sua bio.</span>
                </x-alert>
            @endif
        </x-slot>

        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            <x-dashboard.stat label="Links na cascata" :value="$linksCount" icon="link" />
            <x-dashboard.stat label="Links ativos" :value="$activeLinksCount" icon="check" />
            <x-dashboard.stat
                class="sm:col-span-2 lg:col-span-1"
                label="Página pública"
                :value="$user->handler ? '@'.$user->handler : 'Não definido'"
                icon="user"
            />
        </div>

        <div class="divider my-2">Atalhos</div>

        <div class="grid gap-3 sm:grid-cols-2">
            <x-dashboard.shortcut
                :href="route('profile.index')"
                title="Meu perfil"
                description="Nome, bio, identificador e foto."
                icon="user"
            />
            <x-dashboard.shortcut
                :href="route('links.index')"
                title="Meus links"
                description="Criar, editar e reordenar a cascata."
                icon="link"
                button-variant="secondary"
            />
        </div>

        <div class="mt-2 flex flex-wrap gap-2 border-t border-base-300 pt-4">
            @can('create', \App\Models\Link::class)
                <x-button :href="route('links.create')" icon="plus">Novo link</x-button>
            @endcan
            <x-button :href="route('home')" variant="ghost" size="sm" icon="home">Voltar ao início</x-button>
        </div>
    </x-card>
@endsection
