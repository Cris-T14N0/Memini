<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Folder;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // // 1️⃣ Create the test user
        // $testUser = User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // // 2️⃣ Create folders for the test user
        // $folders = Folder::factory(5)
        //     ->state(['user_id' => $testUser->id])
        //     ->create();

        // // 3️⃣ Create projects with folders
        // foreach ($folders as $folder) {
        //     // Each folder gets 2-3 projects
        //     Project::factory(rand(2, 3))
        //         ->state([
        //             'user_id' => $testUser->id,
        //             'folder_id' => $folder->id,
        //         ])
        //         ->create()
        //         ->each(function ($project) {
        //             // 3-5 albums per project
        //             Album::factory(rand(3, 5))
        //                 ->state([
        //                     'project_id' => $project->id,
        //                 ])
        //                 ->create();
        //         });
        // }

        // // 4️⃣ Create some projects WITHOUT folders
        // Project::factory(3)
        //     ->state([
        //         'user_id' => $testUser->id,
        //         'folder_id' => null,
        //     ])
        //     ->create()
        //     ->each(function ($project) {
        //         Album::factory(rand(2, 4))
        //             ->state([
        //                 'project_id' => $project->id,
        //             ])
        //             ->create();
        //     });

        Role::factory()->viewer()->create();
        Role::factory()->editor()->create();
        
    }
}