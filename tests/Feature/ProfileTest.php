<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_profile_via_store(): void
    {
        $user = User::factory()->create(['handler' => null, 'bio' => null]);

        $response = $this->actingAs($user)->post(route('profile.store'), [
            'name' => 'Renato',
            'handler' => '@renato',
            'bio' => 'Desenvolvedor Laravel.',
        ]);

        $response->assertRedirect(route('profile.index'));
        $response->assertSessionHas('status');

        $user->refresh();
        $this->assertSame('Renato', $user->name);
        $this->assertSame('renato', $user->handler);
        $this->assertSame('Desenvolvedor Laravel.', $user->bio);
    }

    public function test_user_can_upload_avatar_on_profile_store(): void
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'handler' => 'foto-user',
            'bio' => null,
        ]);

        $file = UploadedFile::fake()->image('avatar.jpg', 200, 200);

        $response = $this->actingAs($user)->post(route('profile.store'), [
            'name' => $user->name,
            'handler' => '@foto-user',
            'bio' => 'Com foto.',
            'avatar' => $file,
        ]);

        $response->assertRedirect(route('profile.index'));

        $user->refresh();
        $this->assertNotNull($user->avatar_path);
        Storage::disk('public')->assertExists($user->avatar_path);
        $this->assertStringStartsWith('avatars/', $user->avatar_path);
    }

    public function test_public_profile_shows_active_links_in_order(): void
    {
        $user = User::factory()->create([
            'handler' => 'bio-demo',
            'bio' => 'Olá!',
        ]);

        $user->links()->createMany([
            ['title' => 'Segundo', 'url' => 'https://example.com/2', 'position' => 2, 'is_active' => true],
            ['title' => 'Primeiro', 'url' => 'https://example.com/1', 'position' => 1, 'is_active' => true],
            ['title' => 'Oculto', 'url' => 'https://example.com/x', 'position' => 3, 'is_active' => false],
        ]);

        $response = $this->get(route('biolink.show', 'bio-demo'));

        $response->assertOk();
        $response->assertSeeInOrder(['Primeiro', 'Segundo']);
        $response->assertDontSee('Oculto');
    }
}
