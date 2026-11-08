<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/p/{handler}', [ProfileController::class, 'show'])
    ->where('handler', '[a-zA-Z0-9_-]+')
    ->name('profile.show');

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

    Route::patch('links/{link}/move-up', [LinkController::class, 'moveUp'])
        ->middleware('can:reorder,link')
        ->name('links.move-up');
    Route::patch('links/{link}/move-down', [LinkController::class, 'moveDown'])
        ->middleware('can:reorder,link')
        ->name('links.move-down');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
