<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Links de exemplo para o usuário de demonstração (bio em cascata).
     */
    public function run(): void
    {
        $user = User::query()->where('email', 'test@example.com')->first();

        if ($user === null) {
            return;
        }

        $presets = [
            ['title' => 'Instagram', 'url' => 'https://instagram.com', 'position' => 1],
            ['title' => 'YouTube', 'url' => 'https://youtube.com', 'position' => 2],
            ['title' => 'GitHub', 'url' => 'https://github.com', 'position' => 3],
            ['title' => 'Portfólio', 'url' => 'https://example.com', 'position' => 4],
            ['title' => 'WhatsApp', 'url' => 'https://wa.me/5500000000000', 'position' => 5],
        ];

        foreach ($presets as $preset) {
            Link::query()->updateOrCreate(
                [
                    'user_id' => $user->id,
                    'title' => $preset['title'],
                ],
                [
                    'url' => $preset['url'],
                    'position' => $preset['position'],
                    'is_active' => true,
                ],
            );
        }

        Link::factory()
            ->count(3)
            ->for($user)
            ->sequence(
                ['position' => 6, 'is_active' => true],
                ['position' => 7, 'is_active' => true],
                ['position' => 8, 'is_active' => false],
            )
            ->create();
    }
}
