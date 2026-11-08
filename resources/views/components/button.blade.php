@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary',
    'size' => null,
    'full' => false,
    'outline' => false,
])

@php
    $classes = ['btn'];

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

    if ($full) {
        $classes[] = 'w-full';
    }
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </button>
@endif
