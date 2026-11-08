<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * GET /profile — formulário do perfil (nome, bio, handler).
     */
    public function index(): View
    {
        return view('profile.index', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * POST /profile — valida e persiste o perfil do usuário logado.
     */
    public function store(StoreProfileRequest $request): RedirectResponse
    {
        $request->updateProfile($request->user());

        return redirect()
            ->route('profile.index')
            ->with('status', 'Perfil atualizado com sucesso.');
    }
}
