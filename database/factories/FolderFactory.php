<?php

namespace Database\Factories;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Folder>
 */
class FolderFactory extends Factory
{
    protected $model = Folder::class;

    public function definition(): array
    {
        $availableIcons = ['🎂', '👥', '💪', '🏖️', '🎄', '🎓', '🏠', '💼', '🎮', '📚', '🎵', '🎨', '⚽', '🍕', '✈️'];

        return [
            'user_id' => User::factory(), // This will create a user or use existing
            'name' => $this->faker->words(2, true), // More realistic folder names
            'icon' => $this->faker->randomElement($availableIcons),
        ];
    }

    /**
     * Create a folder for a specific user
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }
}