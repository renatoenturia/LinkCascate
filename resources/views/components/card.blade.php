@props([
    'title' => null,
    'description' => null,
    'bodyClass' => null,
    'centered' => false,
    'bordered' => false,
])

<div {{ $attributes->class([
    'card bg-base-100 shadow-xl',
    'card-border' => $bordered,
    'w-full max-w-md' => $centered,
]) }}>
    <div @class(array_filter(['card-body', $bodyClass]))>
        @isset($heading)
            {{ $heading }}
        @elseif ($title)
            <h1 @class([
                'card-title text-2xl',
                'justify-center' => $centered,
            ])>{{ $title }}</h1>
        @endif

        @if ($description)
            <p @class([
                'text-sm opacity-80',
                'text-center' => $centered,
            ])>{{ $description }}</p>
        @endif

        @isset($header)
            {{ $header }}
        @endisset

        {{ $slot }}

        @isset($actions)
            <div class="card-actions justify-end">
                {{ $actions }}
            </div>
        @endisset
    </div>
</div>
