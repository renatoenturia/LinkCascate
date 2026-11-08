@props([
    'title',
    'description' => null,
    'bodyClass' => 'max-w-lg',
    'centered' => false,
])

<div {{ $attributes->class([
    'card bg-base-100 shadow-xl',
    'w-full max-w-md' => $centered,
]) }}>
    <div @class(['card-body', $bodyClass])>
        <h1 @class([
            'card-title text-2xl',
            'justify-center' => $centered,
        ])>{{ $title }}</h1>

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
    </div>
</div>
