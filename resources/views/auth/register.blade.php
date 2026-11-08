@extends('layouts.guest')

@section('title', 'Cadastro — '.config('app.name'))

@section('content')
    <x-card
        title="Criar conta"
        description="Senha com 8+ caracteres, maiúsculas, minúsculas e números."
        centered
    >
        <x-form :action="route('register')" class="mt-2" spacing="space-y-3">
            <x-input label="Nome" name="name" autocomplete="name" autofocus />
            <x-input label="E-mail" name="email" type="email" autocomplete="email" />
            <x-input label="Confirmar e-mail" name="email_confirmation" type="email" autocomplete="email" />
            <x-input label="Senha" name="password" type="password" autocomplete="new-password" />
            <x-input label="Confirmar senha" name="password_confirmation" type="password" autocomplete="new-password" />

            <x-slot name="actions">
                <x-button type="submit" full>Cadastrar</x-button>
            </x-slot>
        </x-form>

        <p class="text-center text-sm">
            Já tem conta? <a href="{{ route('login') }}" class="link link-primary">Entrar</a>
        </p>
    </x-card>
@endsection
