<form
    method="POST"
    action="{{ route('links.destroy', $link) }}"
    class="{{ $formClass ?? 'inline' }}"
    onsubmit="return confirm(@js("Remover o link «{$link->title}»? Esta ação não pode ser desfeita."))"
>
    @csrf
    @method('DELETE')
    <x-button
        type="submit"
        variant="error"
        :outline="true"
        :size="$buttonSize ?? 'sm'"
        :class="$buttonClass ?? ''"
    >
        {{ $buttonLabel ?? 'Excluir' }}
    </x-button>
</form>
