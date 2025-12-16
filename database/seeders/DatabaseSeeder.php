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
        $randomUsers = User::factory(10)->create();

        // 2️⃣ Test user
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 3️⃣ Create folders for the test user
        $testUserFolders = Folder::factory(5)->forUser($testUser)->create();

        // 4️⃣ Create some folders for random users too
        foreach ($randomUsers->take(3) as $user) {
            Folder::factory(rand(2, 4))->forUser($user)->create();
        }

        // 5️⃣ Create 10 projects for the test user, each with 3 albums
        // Some with folders, some without
        Project::factory()
            ->count(7)
            ->for($testUser, 'owner')
            ->state(fn () => ['folder_id' => $testUserFolders->random()->id])
            ->withAlbums(3)
            ->create();

        // Projects without folders
        Project::factory()
            ->count(3)
            ->for($testUser, 'owner')
            ->state(['folder_id' => null])
            ->withAlbums(3)
            ->create();

        // 6️⃣ Add more projects with random albums
        Project::factory()
            ->count(5)
            ->for($testUser, 'owner')
            ->state(fn () => [
                'folder_id' => rand(0, 100) < 70 // 70% chance of having a folder
                    ? $testUserFolders->random()->id 
                    : null
            ])
            ->withAlbums(rand(4, 6))
            ->create();

        // 7️⃣ Create projects for some random users
        foreach ($randomUsers->take(5) as $user) {
            $userFolders = Folder::where('user_id', $user->id)->get();
            
            Project::factory()
                ->count(rand(3, 8))
                ->for($user, 'owner')
                ->state(fn () => [
                    'folder_id' => $userFolders->isNotEmpty() && rand(0, 100) < 60
                        ? $userFolders->random()->id
                        : null
                ])
                ->withAlbums(rand(2, 5))
                ->create();
        }
    }
}