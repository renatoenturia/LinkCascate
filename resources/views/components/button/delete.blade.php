@props([
    'action',
    'confirm',
    'label' => 'Excluir',
    'size' => 'sm',
])

<form
    method="POST"
    action="{{ $action }}"
    {{ $attributes->class(['inline']) }}
    onsubmit="return confirm(@js($confirm))"
>
    @csrf
    @method('DELETE')
    <x-button.icon
        type="submit"
        icon="trash"
        :label="$label"
        variant="error"
        :outline="true"
        :size="$size"
    />
</form>
