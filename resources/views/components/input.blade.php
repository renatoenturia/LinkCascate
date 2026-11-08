@props([
    'label',
    'name',
    'type' => 'text',
    'value' => null,
    'errorKeys' => null,
])

@php
    $id = $attributes->get('id', $name);
    $keys = $errorKeys ?? [$name];
    $hasError = collect($keys)->contains(fn (string $key) => $errors->has($key));
@endphp

<fieldset class="fieldset">
    <legend class="fieldset-legend">{{ $label }}</legend>

    @isset($hint)
        <div class="text-sm opacity-70">{{ $hint }}</div>
    @endisset

    <input
        id="{{ $id }}"
        type="{{ $type }}"
        name="{{ $name }}"
        @unless($type === 'password')
            value="{{ old($name, $value) }}"
        @endunless
        {{ $attributes->class([
            'input input-bordered w-full',
            'input-error' => $hasError,
        ]) }}
    />

    @foreach ($keys as $key)
        @error($key)
            <p class="text-error text-sm">{{ $message }}</p>
        @enderror
    @endforeach
</fieldset>
