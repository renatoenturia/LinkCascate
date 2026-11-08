@extends('layouts.guest')

@section('title', 'Cadastro — '.config('app.name'))

@section('content')
    <x-ui.page-card
        title="Criar conta"
        description="Senha com 8+ caracteres, maiúsculas, minúsculas e números."
        centered
        body-class=""
    >
        <form method="POST" action="{{ route('register') }}" class="mt-2 space-y-3" novalidate>
            @csrf

            <x-form.input label="Nome" name="name" autocomplete="name" autofocus />
            <x-form.input label="E-mail" name="email" type="email" autocomplete="email" />
            <x-form.input label="Confirmar e-mail" name="email_confirmation" type="email" autocomplete="email" />
            <x-form.input label="Senha" name="password" type="password" autocomplete="new-password" />
            <x-form.input label="Confirmar senha" name="password_confirmation" type="password" autocomplete="new-password" />

            <button type="submit" class="btn btn-primary w-full">Cadastrar</button>
        </form>

        <p class="text-center text-sm">
            Já tem conta? <a href="{{ route('login') }}" class="link link-primary">Entrar</a>
        </p>
    </x-ui.page-card>
@endsection
