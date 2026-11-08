<div class="join join-vertical" role="group" aria-label="Reordenar link">
    @if (! $loop->first)
        <form method="POST" action="{{ route('links.move-up', $link) }}">
            @csrf
            @method('PATCH')
            <x-button type="submit" :outline="true" size="xs" class="join-item" title="Subir na cascata">↑</x-button>
        </form>
    @else
        <x-button type="button" variant="disabled" size="xs" class="join-item" disabled aria-hidden="true">↑</x-button>
    @endif

    @if (! $loop->last)
        <form method="POST" action="{{ route('links.move-down', $link) }}">
            @csrf
            @method('PATCH')
            <x-button type="submit" :outline="true" size="xs" class="join-item" title="Descer na cascata">↓</x-button>
        </form>
    @else
        <x-button type="button" variant="disabled" size="xs" class="join-item" disabled aria-hidden="true">↓</x-button>
    @endif
</div>
