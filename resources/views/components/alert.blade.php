@props([
    'variant' => null,
    'role' => 'alert',
])

<div
    role="{{ $role }}"
    {{ $attributes->class(array_filter([
        'alert',
        $variant ? 'alert-'.$variant : null,
    ])) }}
>
    {{ $slot }}
</div>
