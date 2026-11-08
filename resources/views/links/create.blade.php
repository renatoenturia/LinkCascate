@extends('layouts.app')

@section('title', 'Novo link — '.config('app.name'))

@section('content')
    <x-card title="Novo link" description="Adicione um item à sua cascata de bio links." body-class="max-w-lg">
        <x-form :action="route('links.store')" class="mt-4">
            @include('links._form')

            <x-slot name="actions">
                <x-button type="submit">Salvar</x-button>
                <x-button :href="route('links.index')" variant="ghost">Cancelar</x-button>
            </x-slot>
        </x-form>
    </x-card>
@endsection
