@extends('layouts.app')

@section('title', 'Dashboard — '.config('app.name'))

@section('content')
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h1 class="card-title text-2xl">Dashboard</h1>
            <p class="text-base-content/80">
                Olá, <span class="font-semibold">{{ auth()->user()->name }}</span> — gerencie sua bio em cascata.
            </p>

            @if (auth()->user()->handler)
                <div class="alert alert-info mt-2">
                    <span>
                        Sua página pública:
                        <a href="{{ route('biolink.show', auth()->user()) }}" class="link font-medium" target="_blank" rel="noopener noreferrer">
                            {{ route('biolink.show', auth()->user()) }}
                        </a>
                    </span>
                </div>
            @else
                <div class="alert alert-warning mt-2">
                    <span>Defina seu <a href="{{ route('profile.index') }}" class="link">handler no perfil</a> para publicar sua bio.</span>
                </div>
            @endif

            <div class="divider">Atalhos</div>

            <div class="grid gap-3 sm:grid-cols-2">
                <a href="{{ route('profile.index') }}" class="card card-border bg-base-100 hover:bg-base-200 transition-colors">
                    <div class="card-body">
                        <h2 class="card-title text-lg">Meu perfil</h2>
                        <p class="text-sm opacity-80">Nome, bio, handler e foto.</p>
                        <div class="card-actions justify-end">
                            <span class="btn btn-primary btn-sm">Abrir</span>
                        </div>
                    </div>
                </a>
                <a href="{{ route('links.index') }}" class="card card-border bg-base-100 hover:bg-base-200 transition-colors">
                    <div class="card-body">
                        <h2 class="card-title text-lg">Meus links</h2>
                        <p class="text-sm opacity-80">Criar, editar e reordenar a cascata.</p>
                        <div class="card-actions justify-end">
                            <span class="btn btn-secondary btn-sm">Abrir</span>
                        </div>
                    </div>
                </a>
            </div>

            <a href="{{ route('home') }}" class="btn btn-ghost btn-sm mt-4">Voltar ao início</a>
        </div>
    </div>
@endsection
