@props([
    'link',
    'first' => false,
    'last' => false,
])

<div class="join join-vertical" role="group" aria-label="Reordenar link">
    @if (! $first)
        <form method="POST" action="{{ route('links.move-up', $link) }}">
            @csrf
            @method('PATCH')
            <x-button.icon
                type="submit"
                icon="arrow-up"
                label="Subir na cascata"
                :outline="true"
                size="xs"
                class="join-item"
            />
        </form>
    @else
        <x-button.icon
            type="button"
            icon="arrow-up"
            label="Subir na cascata"
            variant="disabled"
            size="xs"
            class="join-item"
            disabled
            aria-hidden="true"
        />
    @endif

    @if (! $last)
        <form method="POST" action="{{ route('links.move-down', $link) }}">
            @csrf
            @method('PATCH')
            <x-button.icon
                type="submit"
                icon="arrow-down"
                label="Descer na cascata"
                :outline="true"
                size="xs"
                class="join-item"
            />
        </form>
    @else
        <x-button.icon
            type="button"
            icon="arrow-down"
            label="Descer na cascata"
            variant="disabled"
            size="xs"
            class="join-item"
            disabled
            aria-hidden="true"
        />
    @endif
</div>
