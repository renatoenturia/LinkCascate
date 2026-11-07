<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LinkController extends Controller
{
    public function index(): View
    {
        $links = auth()->user()
            ->links()
            ->orderBy('position')
            ->orderBy('id')
            ->get();

        return view('links.index', compact('links'));
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

    public function edit(Link $link): View
    {
        $this->ensureLinkBelongsToCurrentUser($link);

        return view('links.edit', compact('link'));
    }

    public function update(UpdateLinkRequest $request, Link $link): RedirectResponse
    {
        $this->ensureLinkBelongsToCurrentUser($link);

        $request->tryToUpdateLink($link);

        return redirect()
            ->route('links.index')
            ->with('status', 'Link atualizado com sucesso.');
    }

    public function destroy(Link $link): RedirectResponse
    {
        $this->ensureLinkBelongsToCurrentUser($link);

        $link->delete();

        return redirect()
            ->route('links.index')
            ->with('status', 'Link removido com sucesso.');
    }

    private function ensureLinkBelongsToCurrentUser(Link $link): void
    {
        abort_unless($link->user_id === auth()->id(), 403);
    }
}
