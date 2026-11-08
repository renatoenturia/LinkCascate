<?php

namespace Tests\Unit;

use App\Models\Link;
use App\Models\User;
use App\Policies\LinkPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_update_and_delete_but_not_stranger(): void
    {
        $owner = User::factory()->create();
        $stranger = User::factory()->create();
        $link = Link::factory()->for($owner)->create();

        $policy = new LinkPolicy;

        $this->assertTrue($policy->update($owner, $link));
        $this->assertTrue($policy->delete($owner, $link));
        $this->assertTrue($policy->reorder($owner, $link));

        $this->assertFalse($policy->update($stranger, $link));
        $this->assertFalse($policy->delete($stranger, $link));
        $this->assertFalse($policy->reorder($stranger, $link));
    }
}
