<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id'    => User::factory(), // cria user automaticamente
            'name'       => $this->faker->sentence(3),
            'description'=> $this->faker->paragraph(),
            'completed'  => $this->faker->boolean(30), 
            // 30% concluídos, 70% em progresso
        ];
    }

    /**
     * Estado: Projeto concluído
     */
    public function completed(): static
    {
        return $this->state(fn () => [
            'completed' => true,
        ]);
    }

    /**
     * Estado: Projeto em progresso
     */
    public function inProgress(): static
    {
        return $this->state(fn () => [
            'completed' => false,
        ]);
    }
}
