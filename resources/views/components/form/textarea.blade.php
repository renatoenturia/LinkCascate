@props([
    'label',
    'name',
    'value' => null,
    'rows' => 4,
])

@php
    $id = $attributes->get('id', $name);
    $hasError = $errors->has($name);
@endphp

<fieldset class="fieldset">
    <legend class="fieldset-legend">{{ $label }}</legend>

    @isset($hint)
        <div class="text-sm opacity-70">{{ $hint }}</div>
    @endisset

    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        {{ $attributes->class([
            'textarea textarea-bordered w-full',
            'textarea-error' => $hasError,
        ]) }}
    >{{ old($name, $value) }}</textarea>

    @error($name)
        <p class="text-error text-sm">{{ $message }}</p>
    @enderror
</fieldset>
