@props([
    'href' => null,
    'type' => 'button',
    'icon',
    'label',
    'variant' => 'primary',
    'size' => 'sm',
    'outline' => false,
])

@php
    $classes = ['btn', 'btn-square'];

    if ($outline) {
        $classes[] = 'btn-outline';
        if ($variant !== 'primary') {
            $classes[] = 'btn-'.$variant;
        }
    } else {
        $classes[] = match ($variant) {
            'disabled' => 'btn-disabled',
            default => 'btn-'.$variant,
        };
    }

    if ($size) {
        $classes[] = 'btn-'.$size;
    }
@endphp

@if ($href)
    <a
        href="{{ $href }}"
        {{ $attributes->class($classes) }}
        aria-label="{{ $label }}"
        title="{{ $label }}"
    >
        <x-icon :name="$icon" @class(['size-4' => $size === 'xs', 'size-5' => $size !== 'xs']) />
    </a>
@else
    <button
        type="{{ $type }}"
        {{ $attributes->class($classes) }}
        aria-label="{{ $label }}"
        title="{{ $label }}"
    >
        <x-icon :name="$icon" @class(['size-4' => $size === 'xs', 'size-5' => $size !== 'xs']) />
    </button>
@endif
