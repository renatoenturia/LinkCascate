@props([
    'label',
    'name',
    'type' => 'text',
    'value' => null,
    'errorKeys' => null,
])

<x-input
    :label="$label"
    :name="$name"
    :type="$type"
    :value="$value"
    :error-keys="$errorKeys"
    {{ $attributes }}
>
    @isset($hint)
        <x-slot name="hint">{{ $hint }}</x-slot>
    @endisset
</x-input>
