<form
    method="POST"
    action="{{ route('links.destroy', $link) }}"
    class="{{ $formClass ?? 'inline' }}"
    onsubmit="return confirm(@js("Remover o link «{$link->title}»? Esta ação não pode ser desfeita."))"
>
    @csrf
    @method('DELETE')
    <button type="submit" class="{{ $buttonClass ?? 'btn btn-error btn-outline btn-sm' }}">
        {{ $buttonLabel ?? 'Excluir' }}
    </button>
</form>
