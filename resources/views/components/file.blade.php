@props([
    'label',
    'name',
    'accept' => null,
    'help' => null,
    'previewUrl' => null,
    'previewAlt' => '',
    'placeholderText' => 'Sem foto',
    'chooseLabel' => 'Escolher arquivo',
    'emptyLabel' => 'Nenhum arquivo selecionado',
])

@php
    $id = $attributes->get('id', $name);
    $hasError = $errors->has($name);
    $filenameId = $id.'-filename';
@endphp

<fieldset class="fieldset">
    <legend class="fieldset-legend">{{ $label }}</legend>

    @isset($hint)
        <div class="text-sm opacity-70">{{ $hint }}</div>
    @endisset

    <div class="flex items-center gap-4">
        @isset($preview)
            {{ $preview }}
        @elseif ($previewUrl)
            <div class="avatar">
                <div class="w-20 rounded-full">
                    <img src="{{ $previewUrl }}" alt="{{ $previewAlt }}">
                </div>
            </div>
        @else
            <div class="avatar avatar-placeholder">
                <div class="bg-neutral text-neutral-content w-20 rounded-full">
                    <span class="text-xs">{{ $placeholderText }}</span>
                </div>
            </div>
        @endif

        <div class="min-w-0 flex-1 max-w-xs space-y-2">
            <label
                for="{{ $id }}"
                @class([
                    'btn btn-outline w-full cursor-pointer sm:w-auto',
                    'btn-error' => $hasError,
                ])
            >
                {{ $chooseLabel }}
            </label>
            <input
                id="{{ $id }}"
                type="file"
                name="{{ $name }}"
                @if ($accept) accept="{{ $accept }}" @endif
                class="hidden"
                data-file-label="{{ $filenameId }}"
                @if ($hasError) aria-invalid="true" @endif
                {{ $attributes->except('class') }}
            />
            <p
                id="{{ $filenameId }}"
                class="truncate text-sm opacity-80"
                aria-live="polite"
                data-empty="{{ $emptyLabel }}"
            >
                {{ $emptyLabel }}
            </p>
        </div>
    </div>

    @if ($help)
        <p class="text-xs opacity-70">{{ $help }}</p>
    @endif

    @error($name)
        <p class="text-error text-sm">{{ $message }}</p>
    @enderror
</fieldset>
