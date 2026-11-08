@props([
    'submitLabel' => 'Salvar',
])

<div {{ $attributes->class(['flex flex-wrap gap-2']) }}>
    <x-button type="submit" :variant="$submitVariant ?? 'primary'">
        {{ $submitLabel }}
    </x-button>
    {{ $slot }}
</div>
