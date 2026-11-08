<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'handler' => 'testuser',
            'bio' => 'Perfil de demonstração do LinkCascate — links em cascata para sua bio.',
        ]);

        $this->call([
            LinkSeeder::class,
        ]);
    }
}
