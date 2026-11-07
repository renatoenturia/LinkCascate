<?php

namespace Tests\Feature;

use App\Models\Link;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkReorderTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_move_link_down_via_patch(): void
    {
        $user = User::factory()->create();
        $first = Link::factory()->for($user)->create(['position' => 1]);
        $second = Link::factory()->for($user)->create(['position' => 2]);

        $response = $this->actingAs($user)->patch(route('links.move-down', $first));

        $response->assertRedirect(route('links.index'));
        $response->assertSessionHas('status');

        $this->assertSame(2, $first->fresh()->position);
        $this->assertSame(1, $second->fresh()->position);
    }

    public function test_guest_cannot_reorder_links(): void
    {
        $user = User::factory()->create();
        $link = Link::factory()->for($user)->create();

        $response = $this->patch(route('links.move-up', $link));

        $response->assertRedirect(route('login'));
    }

    public function test_user_cannot_reorder_another_users_link(): void
    {
        $owner = User::factory()->create();
        $intruder = User::factory()->create();
        $link = Link::factory()->for($owner)->create(['position' => 1]);

        $response = $this->actingAs($intruder)->patch(route('links.move-up', $link));

        $response->assertNotFound();
    }
}
