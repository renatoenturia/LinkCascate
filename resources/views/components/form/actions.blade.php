@props([
    'submitLabel' => 'Salvar',
])

<div {{ $attributes->class(['flex flex-wrap gap-2 pt-2']) }}>
    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
    {{ $slot }}
</div>
