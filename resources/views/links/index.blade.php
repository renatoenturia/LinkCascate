@extends('layouts.app')

@section('title', 'Meus links — '.config('app.name'))

@section('content')
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="card-title text-2xl">Meus links</h1>
                    <p class="text-sm opacity-80">
                        {{ $activeLinks }} ativo(s) de {{ $totalLinks }} — ordem da cascata.
                    </p>
                </div>
                @can('create', \App\Models\Link::class)
                    <a href="{{ route('links.create') }}" class="btn btn-primary">Novo link</a>
                @endcan
            </div>

            <ul class="mt-4 space-y-2">
                @forelse ($links as $link)
                    <li class="card card-border bg-base-100">
                        <div class="card-body flex flex-col gap-3 p-4 sm:flex-row sm:items-center sm:justify-between">
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
                                    <a href="{{ route('links.edit', $link) }}" class="btn btn-outline btn-sm">Editar</a>
                                @endcan
                                @can('delete', $link)
                                    @include('links._destroy-form', ['link' => $link])
                                @endcan
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="alert">
                        <span>
                            Nenhum link ainda.
                            <a href="{{ route('links.create') }}" class="link link-primary">Criar o primeiro</a>
                        </span>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
