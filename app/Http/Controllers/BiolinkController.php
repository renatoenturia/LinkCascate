<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

/**
 * Páginas públicas de bio link — URLs dedicadas, sem autenticação.
 */
class BiolinkController extends Controller
{
    /**
     * GET /p/{user:handler}
     *
     * O parâmetro {user:handler} usa Route Model Binding customizado:
     * busca User pela coluna handler (ver User::resolveRouteBinding).
     */
    public function show(User $user): View
    {
        $links = $user->links()
            ->where('is_active', true)
            ->orderBy('position')
            ->orderBy('id')
            ->get();

        return view('biolink.show', [
            'user' => $user,
            'links' => $links,
        ]);
    }
}
