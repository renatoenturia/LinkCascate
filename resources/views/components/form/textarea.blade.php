@props([
    'label',
    'name',
    'value' => null,
    'rows' => 4,
])

<x-textarea
    :label="$label"
    :name="$name"
    :value="$value"
    :rows="$rows"
    {{ $attributes }}
>
    @isset($hint)
        <x-slot name="hint">{{ $hint }}</x-slot>
    @endisset
</x-textarea>
