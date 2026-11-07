<?php

namespace App\Services;

use App\Models\Link;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LinkReorderer
{
    public function moveUp(Link $link): bool
    {
        return $this->move($link, -1);
    }

    public function moveDown(Link $link): bool
    {
        return $this->move($link, 1);
    }

    /**
     * Troca a posição com o vizinho na lista ordenada (position, id).
     */
    public function move(Link $link, int $direction): bool
    {
        if (! in_array($direction, [-1, 1], true)) {
            return false;
        }

        $ordered = $this->orderedLinksFor($link);
        $currentIndex = $ordered->search(fn (Link $item) => $item->is($link));

        if ($currentIndex === false) {
            return false;
        }

        $neighborIndex = $currentIndex + $direction;

        if (! $ordered->has($neighborIndex)) {
            return false;
        }

        $this->swapPositions($link, $ordered[$neighborIndex]);

        return true;
    }

    /**
     * @return Collection<int, Link>
     */
    public function orderedLinksFor(Link $link): Collection
    {
        return $link->user
            ->links()
            ->orderBy('position')
            ->orderBy('id')
            ->get();
    }

    public function swapPositions(Link $a, Link $b): void
    {
        DB::transaction(function () use ($a, $b) {
            $positionA = $a->position;

            $a->update(['position' => $b->position]);
            $b->update(['position' => $positionA]);
        });
    }
}
