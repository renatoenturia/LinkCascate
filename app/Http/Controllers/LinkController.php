<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Link;
use App\Services\LinkReorderer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LinkController extends Controller
{
    public function __construct(private LinkReorderer $reorderer)
    {
        // Mapeia index→viewAny, create/store→create, edit/update→update, destroy→delete
        $this->authorizeResource(Link::class, 'link');
    }

    /**
     * GET /links — rota nomeada links.index (Route::resource).
     * Os dados são enviados à view como variáveis de template.
     */
    public function index(): View
    {
        $links = auth()->user()
            ->links()
            ->orderBy('position')
            ->orderBy('id')
            ->get();

        return view('links.index', [
            'links' => $links,
            'totalLinks' => $links->count(),
            'activeLinks' => $links->where('is_active', true)->count(),
        ]);
    }

    public function create(): View
    {
        return view('links.create');
    }

    public function store(StoreLinkRequest $request): RedirectResponse
    {
        $request->tryToCreateLink();

        return redirect()
            ->route('links.index')
            ->with('status', 'Link criado com sucesso.');
    }

    /**
     * GET /links/{link}/edit — o parâmetro {link} injeta o model via Route Model Binding.
     */
    public function edit(Link $link): View
    {
        return view('links.edit', compact('link'));
    }

    /**
     * PUT /links/{link} — formulário com @method('PUT') e POST + _method.
     */
    public function update(UpdateLinkRequest $request, Link $link): RedirectResponse
    {
        $request->tryToUpdateLink($link);

        return redirect()
            ->route('links.index')
            ->with('status', 'Link atualizado com sucesso.');
    }

    public function moveUp(Link $link): RedirectResponse
    {
        $this->authorize('reorder', $link);

        return $this->redirectAfterReorder($link, $this->reorderer->moveUp($link), 'subiu');
    }

    public function moveDown(Link $link): RedirectResponse
    {
        $this->authorize('reorder', $link);

        return $this->redirectAfterReorder($link, $this->reorderer->moveDown($link), 'desceu');
    }

    /**
     * DELETE /links/{link} — ação HTTP no controller chama-se destroy (convenção REST).
     *
     * O registro é removido com $link->delete() no Eloquent; o método do model continua
     * sendo delete(), pois destroy() aqui é só o nome da ação do resource controller.
     */
    public function destroy(Link $link): RedirectResponse
    {
        $title = $link->title;

        $link->delete();

        return redirect()
            ->route('links.index')
            ->with('status', "Link «{$title}» removido com sucesso.");
    }

    private function redirectAfterReorder(Link $link, bool $moved, string $direction): RedirectResponse
    {
        if (! $moved) {
            return redirect()
                ->route('links.index')
                ->with('status', 'Este link já está no limite da lista.');
        }

        return redirect()
            ->route('links.index')
            ->with('status', "Link «{$link->title}» {$direction} na cascata.");
    }
}
