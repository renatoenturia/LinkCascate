@props([
    'action',
    'method' => 'POST',
    'multipart' => false,
    'spacing' => 'space-y-4',
])

@php
    $httpMethod = strtoupper($method);
    $needsMethodSpoof = in_array($httpMethod, ['PUT', 'PATCH', 'DELETE'], true);
@endphp

<form
    method="{{ $needsMethodSpoof ? 'POST' : $httpMethod }}"
    action="{{ $action }}"
    @if ($multipart) enctype="multipart/form-data" @endif
    {{ $attributes->class([$spacing]) }}
    novalidate
>
    @csrf
    @if ($needsMethodSpoof)
        @method($httpMethod)
    @endif

    {{ $slot }}

    @isset($actions)
        <div class="flex flex-wrap gap-2 pt-2">
            {{ $actions }}
        </div>
    @endisset
</form>
