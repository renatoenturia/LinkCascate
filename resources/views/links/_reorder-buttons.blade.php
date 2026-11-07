<div class="flex flex-col gap-1" role="group" aria-label="Reordenar link">
    @if (! $loop->first)
        <form method="POST" action="{{ route('links.move-up', $link) }}">
            @csrf
            @method('PATCH')
            <button
                type="submit"
                title="Subir na cascata"
                class="rounded-md border border-gray-300 px-2 py-1 text-xs text-gray-700 hover:bg-gray-50"
            >
                ↑ Subir
            </button>
        </form>
    @else
        <span class="rounded-md border border-transparent px-2 py-1 text-xs text-gray-300" aria-hidden="true">↑ Subir</span>
    @endif

    @if (! $loop->last)
        <form method="POST" action="{{ route('links.move-down', $link) }}">
            @csrf
            @method('PATCH')
            <button
                type="submit"
                title="Descer na cascata"
                class="rounded-md border border-gray-300 px-2 py-1 text-xs text-gray-700 hover:bg-gray-50"
            >
                ↓ Descer
            </button>
        </form>
    @else
        <span class="rounded-md border border-transparent px-2 py-1 text-xs text-gray-300" aria-hidden="true">↓ Descer</span>
    @endif
</div>
