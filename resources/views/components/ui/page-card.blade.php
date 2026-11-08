@props([
    'title',
    'description' => null,
    'bodyClass' => 'max-w-lg',
    'centered' => false,
])

<x-card
    :title="$title"
    :description="$description"
    :body-class="$bodyClass"
    :centered="$centered"
    {{ $attributes }}
>
    @isset($header)
        <x-slot name="header">{{ $header }}</x-slot>
    @endisset

    {{ $slot }}
</x-card>
