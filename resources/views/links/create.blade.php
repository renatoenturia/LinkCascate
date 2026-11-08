@extends('layouts.app')

@section('title', 'Novo link — '.config('app.name'))

@section('content')
    <x-ui.page-card title="Novo link" description="Adicione um item à sua cascata de bio links.">
        <form method="POST" action="{{ route('links.store') }}" class="mt-4 space-y-4" novalidate>
            @csrf
            @include('links._form')

            <x-form.actions submit-label="Salvar">
                <a href="{{ route('links.index') }}" class="btn btn-ghost">Cancelar</a>
            </x-form.actions>
        </form>
    </x-ui.page-card>
@endsection
