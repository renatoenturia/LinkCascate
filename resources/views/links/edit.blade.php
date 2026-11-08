@extends('layouts.app')

@section('title', 'Editar link — '.config('app.name'))

@section('content')
    <x-ui.page-card title="Editar link" description="Atualize título, URL, posição e visibilidade.">
        <form method="POST" action="{{ route('links.update', $link) }}" class="mt-4 space-y-4" novalidate>
            @csrf
            @method('PUT')
            @include('links._form', ['link' => $link])

            <x-form.actions submit-label="Atualizar">
                <a href="{{ route('links.index') }}" class="btn btn-ghost">Voltar</a>
            </x-form.actions>
        </form>

        @can('delete', $link)
            <div class="divider text-error">Zona de perigo</div>
            <p class="text-sm opacity-80">Remove este link permanentemente da sua cascata.</p>
            @include('links._destroy-form', [
                'link' => $link,
                'buttonClass' => 'btn btn-error btn-sm mt-2',
                'buttonLabel' => 'Excluir link',
            ])
        @endcan
    </x-ui.page-card>
@endsection
