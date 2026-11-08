@props([
    'href',
    'title',
    'description',
    'icon',
    'buttonVariant' => 'primary',
    'buttonLabel' => 'Abrir',
])

<x-card bordered {{ $attributes->class(['bg-base-100 shadow-none transition-colors hover:bg-base-200']) }}>
    <div class="flex items-start gap-3">
        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-base-200 text-primary">
            <x-icon :name="$icon" class="!h-5 !w-5" />
        </div>
        <div class="min-w-0 flex-1">
            <h2 class="text-lg font-semibold leading-tight">{{ $title }}</h2>
            <p class="mt-1 text-sm font-normal opacity-80">{{ $description }}</p>
        </div>
    </div>

    <x-slot name="actions">
        <x-button :href="$href" :variant="$buttonVariant" size="sm" icon="external">
            {{ $buttonLabel }}
        </x-button>
    </x-slot>
</x-card>
