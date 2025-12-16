<?php

namespace Database\Seeders;

use App\Models\Folder;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Random users
        User::factory(10)->create();

        // 2️⃣ Test user
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 3️⃣ Ensure some folders exist
        $folders = Folder::factory(5)->create();

        // 4️⃣ Create 10 projects for the test user, each with 3 albums
        Project::factory()
            ->count(10)
            ->for($testUser, 'owner') // Use owner() relationship
            ->state(fn () => ['folder_id' => $folders->random()->id])
            ->withAlbums(3)
            ->create();

        // 5️⃣ Add more projects with random albums
        Project::factory()
            ->count(5)
            ->for($testUser, 'owner')
            ->state(fn () => ['folder_id' => $folders->random()->id])
            ->withAlbums(rand(4, 6))
            ->create();
    }
}
