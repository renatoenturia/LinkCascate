{{--
    DELETE via POST: browsers só enviam GET/POST com formulários.
    @csrf protege contra CSRF; @method('DELETE') gera _method para o Laravel.
    Rota: links.destroy → LinkController::destroy (não "delete": evita conflito de nome).
--}}
<form
    method="POST"
    action="{{ route('links.destroy', $link) }}"
    class="{{ $formClass ?? '' }}"
    onsubmit="return confirm(@js("Remover o link «{$link->title}»? Esta ação não pode ser desfeita."))"
>
    @csrf
    @method('DELETE')
    <button
        type="submit"
        class="{{ $buttonClass ?? 'rounded-md border border-red-200 px-3 py-1.5 text-sm text-red-700 hover:bg-red-50' }}"
    >
        {{ $buttonLabel ?? 'Excluir' }}
    </button>
</form>
