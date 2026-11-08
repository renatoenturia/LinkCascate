<div class="join join-vertical" role="group" aria-label="Reordenar link">
    @if (! $loop->first)
        <form method="POST" action="{{ route('links.move-up', $link) }}">
            @csrf
            @method('PATCH')
            <button type="submit" title="Subir na cascata" class="btn btn-outline btn-xs join-item">↑</button>
        </form>
    @else
        <button type="button" disabled class="btn btn-disabled btn-xs join-item" aria-hidden="true">↑</button>
    @endif

    @if (! $loop->last)
        <form method="POST" action="{{ route('links.move-down', $link) }}">
            @csrf
            @method('PATCH')
            <button type="submit" title="Descer na cascata" class="btn btn-outline btn-xs join-item">↓</button>
        </form>
    @else
        <button type="button" disabled class="btn btn-disabled btn-xs join-item" aria-hidden="true">↓</button>
    @endif
</div>
