@extends('layouts.app')

@section('title', 'Meus links — '.config('app.name'))

@section('content')
    <x-card>
        <x-slot name="heading">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="card-title text-2xl">Meus links</h1>
                    <p class="text-sm opacity-80">
                        {{ $activeLinks }} ativo(s) de {{ $totalLinks }} — ordem da cascata.
                    </p>
                </div>
                @can('create', \App\Models\Link::class)
                    <x-button :href="route('links.create')">Novo link</x-button>
                @endcan
            </div>
        </x-slot>

        <ul class="mt-4 space-y-2">
            @forelse ($links as $link)
                <li>
                    <x-card bordered class="shadow-none">
                        <div class="flex flex-col gap-3 p-4 sm:flex-row sm:items-center sm:justify-between">
                            <div class="min-w-0 flex-1">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="badge badge-neutral badge-sm">{{ $link->position }}</span>
                                    <span class="font-medium">{{ $link->title }}</span>
                                    @unless ($link->is_active)
                                        <span class="badge badge-warning badge-outline">Inativo</span>
                                    @endunless
                                </div>
                                <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="link link-primary mt-1 block truncate text-sm">
                                    {{ $link->url }}
                                </a>
                            </div>
                            <div class="flex flex-wrap items-center gap-2">
                                @can('reorder', $link)
                                    @include('links._reorder-buttons', ['link' => $link])
                                @endcan
                                @can('update', $link)
                                    <x-button :href="route('links.edit', $link)" variant="primary" :outline="true" size="sm">Editar</x-button>
                                @endcan
                                @can('delete', $link)
                                    @include('links._destroy-form', ['link' => $link])
                                @endcan
                            </div>
                        </div>
                    </x-card>
                </li>
            @empty
                <li>
                    <x-alert>
                        <span>
                            Nenhum link ainda.
                            <a href="{{ route('links.create') }}" class="link link-primary">Criar o primeiro</a>
                        </span>
                    </x-alert>
                </li>
            @endforelse
        </ul>
    </x-card>
@endsection
