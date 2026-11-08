@extends('layouts.guest')

@section('title', 'Login — '.config('app.name'))

@section('content')
    <x-ui.page-card title="Entrar" centered body-class="">
        <form method="POST" action="{{ route('login') }}" class="mt-2 space-y-4" novalidate>
            @csrf

            <x-form.input
                label="E-mail"
                name="email"
                type="email"
                autocomplete="email"
                autofocus
            />

            <x-form.input
                label="Senha"
                name="password"
                type="password"
                autocomplete="current-password"
            />

            <x-form.checkbox label="Lembrar de mim" name="remember" id="remember" />

            <button type="submit" class="btn btn-primary w-full">Entrar</button>
        </form>

        <p class="text-center text-sm">
            Ainda não tem conta?
            <a href="{{ route('register') }}" class="link link-primary">Cadastre-se</a>
        </p>
        <p class="text-center text-sm">
            <a href="{{ route('home') }}" class="link link-hover">Voltar ao início</a>
        </p>
    </x-ui.page-card>
@endsection
