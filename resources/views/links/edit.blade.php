@extends('layouts.app')

@section('title', 'Editar link — '.config('app.name'))

@section('content')
    <x-card title="Editar link" description="Atualize título, URL, posição e visibilidade." body-class="max-w-lg">
        <x-form :action="route('links.update', $link)" method="PUT" class="mt-4">
            @include('links._form', ['link' => $link])

            <x-slot name="actions">
                <x-button type="submit">Atualizar</x-button>
                <x-button :href="route('links.index')" variant="ghost">Voltar</x-button>
            </x-slot>
        </x-form>

        @can('delete', $link)
            <div class="divider text-error">Zona de perigo</div>
            <p class="text-sm opacity-80">Remove este link permanentemente da sua cascata.</p>
            @include('links._destroy-form', [
                'link' => $link,
                'buttonLabel' => 'Excluir link',
                'buttonClass' => 'mt-2',
            ])
        @endcan
    </x-card>
@endsection
