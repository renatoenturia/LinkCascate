<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Models\User;
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

    /**
     * GET /p/{handler} — página pública da bio (convidados).
     */
    public function show(string $handler): View
    {
        $user = User::query()
            ->where('handler', $handler)
            ->firstOrFail();

        $links = $user->links()
            ->where('is_active', true)
            ->orderBy('position')
            ->orderBy('id')
            ->get();

        return view('profile.show', compact('user', 'links'));
    }
}
