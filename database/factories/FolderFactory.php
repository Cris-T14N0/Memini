<?php

namespace Database\Factories;

use App\Models\Folder;
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
            'name' => $this->faker->word(),
            'icon' => $this->faker->randomElement($availableIcons),
        ];
    }
}
