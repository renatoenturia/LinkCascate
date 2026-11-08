@extends('layouts.guest')

@section('title', 'Login — '.config('app.name'))

@section('content')
    <x-card title="Entrar" centered>
        <x-form :action="route('login')" class="mt-2" spacing="space-y-4">
            <x-input label="E-mail" name="email" type="email" autocomplete="email" autofocus />
            <x-input label="Senha" name="password" type="password" autocomplete="current-password" />
            <x-form.checkbox label="Lembrar de mim" name="remember" id="remember" />

            <x-slot name="actions">
                <x-button type="submit" full>Entrar</x-button>
            </x-slot>
        </x-form>

        <p class="text-center text-sm">
            Ainda não tem conta?
            <a href="{{ route('register') }}" class="link link-primary">Cadastre-se</a>
        </p>
        <p class="text-center text-sm">
            <a href="{{ route('home') }}" class="link link-hover">Voltar ao início</a>
        </p>
    </x-card>
@endsection
