<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Folder;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'folder_id' => Folder::factory(),
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'completed' => $this->faker->boolean(30),
        ];
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'completed' => true,
        ]);
    }

    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'completed' => false,
        ]);
    }

    public function withAlbums(int $count): static
    {
        return $this->has(Album::factory()->count($count), 'albums');
    }
}
