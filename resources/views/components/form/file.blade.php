@props([
    'label',
    'name',
    'accept' => null,
    'help' => null,
    'previewUrl' => null,
    'previewAlt' => '',
    'placeholderText' => 'Sem foto',
])

<x-file
    :label="$label"
    :name="$name"
    :accept="$accept"
    :help="$help"
    :preview-url="$previewUrl"
    :preview-alt="$previewAlt"
    :placeholder-text="$placeholderText"
    {{ $attributes }}
>
    @isset($hint)
        <x-slot name="hint">{{ $hint }}</x-slot>
    @endisset
    @isset($preview)
        <x-slot name="preview">{{ $preview }}</x-slot>
    @endisset
</x-file>
