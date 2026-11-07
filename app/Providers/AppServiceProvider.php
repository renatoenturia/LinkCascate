<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra bindings e serviços no container (executado cedo, em todo o ciclo de vida da app).
     */
    public function register(): void
    {
        //
    }

    /**
     * Inicializa comportamentos globais após todos os providers terem sido registrados.
     */
    public function boot(): void
    {
        /*
         * Models em modo unguarded: não é necessário $fillable/$guarded em cada model.
         * A proteção contra mass assignment fica nos Form Requests — use validated() ou
         * safe()->only([...]) antes de User::create(), update(), etc.
         */
        Model::unguard();
    }
}
