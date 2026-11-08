@props([
    'label',
    'name',
    'checked' => false,
    'value' => '1',
    'unsetValue' => null,
])

@if ($unsetValue !== null)
    <input type="hidden" name="{{ $name }}" value="{{ $unsetValue }}">
@endif

<label class="label cursor-pointer justify-start gap-2">
    <input
        id="{{ $attributes->get('id', $name) }}"
        type="checkbox"
        name="{{ $name }}"
        value="{{ $value }}"
        @checked(old($name, $checked))
        {{ $attributes->class(['checkbox checkbox-sm', 'checkbox-error' => $errors->has($name)]) }}
    >
    <span class="label-text">{{ $label }}</span>
</label>

@error($name)
    <p class="text-error text-sm">{{ $message }}</p>
@enderror
