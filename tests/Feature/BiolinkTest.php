<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BiolinkTest extends TestCase
{
    use RefreshDatabase;

    public function test_biolink_show_resolves_user_by_handler_via_route_binding(): void
    {
        $user = User::factory()->create([
            'handler' => 'meu-bio',
            'name' => 'Bio Pública',
        ]);

        $response = $this->get(route('biolink.show', 'meu-bio'));

        $response->assertOk();
        $response->assertSee('Bio Pública');
    }

    public function test_biolink_returns_404_for_unknown_handler(): void
    {
        $response = $this->get(route('biolink.show', 'nao-existe'));

        $response->assertNotFound();
    }
}
