<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Entrada HTTP do cadastro. Validação e persistência estão em {@see RegisterRequest}.
 */
class RegisterController extends Controller
{
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    /**
     * O type-hint RegisterRequest dispara a validação antes deste corpo executar.
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = $request->tryToRegister();

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->intended('/');
    }
}
