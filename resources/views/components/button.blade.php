@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary',
    'size' => null,
    'full' => false,
    'outline' => false,
    'icon' => null,
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

    if ($icon) {
        $classes[] = 'gap-2';
    }
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>
        @if ($icon)
            <x-icon :name="$icon" class="size-4" />
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>
        @if ($icon)
            <x-icon :name="$icon" class="size-4" />
        @endif
        {{ $slot }}
    </button>
@endif
