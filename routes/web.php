<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // {link} → Route Model Binding (Link::resolveRouteBinding + firstOrFail)
    // links.edit = GET /links/{link}/edit | links.update = PUT /links/{link}
    Route::resource('links', LinkController::class)->except(['show']);

    Route::patch('links/{link}/move-up', [LinkController::class, 'moveUp'])->name('links.move-up');
    Route::patch('links/{link}/move-down', [LinkController::class, 'moveDown'])->name('links.move-down');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
