<?php

namespace Tests\Unit;

use App\Models\Link;
use App\Models\User;
use App\Services\LinkReorderer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkReordererTest extends TestCase
{
    use RefreshDatabase;

    public function test_move_down_swaps_positions_with_next_link(): void
    {
        $user = User::factory()->create();
        $first = Link::factory()->for($user)->create(['title' => 'A', 'position' => 1]);
        $second = Link::factory()->for($user)->create(['title' => 'B', 'position' => 2]);

        $reorderer = new LinkReorderer;

        $this->assertTrue($reorderer->moveDown($first));

        $this->assertSame(2, $first->fresh()->position);
        $this->assertSame(1, $second->fresh()->position);
    }

    public function test_move_up_swaps_positions_with_previous_link(): void
    {
        $user = User::factory()->create();
        $first = Link::factory()->for($user)->create(['title' => 'A', 'position' => 1]);
        $second = Link::factory()->for($user)->create(['title' => 'B', 'position' => 2]);

        $reorderer = new LinkReorderer;

        $this->assertTrue($reorderer->moveUp($second));

        $this->assertSame(2, $first->fresh()->position);
        $this->assertSame(1, $second->fresh()->position);
    }

    public function test_cannot_move_up_when_already_first(): void
    {
        $user = User::factory()->create();
        $link = Link::factory()->for($user)->create(['position' => 1]);

        $reorderer = new LinkReorderer;

        $this->assertFalse($reorderer->moveUp($link));
    }
}
