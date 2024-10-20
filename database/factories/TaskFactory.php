<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Generate a random sentence for the 'title' attribute
            'title' => fake()->sentence(),
            // Generate a random paragraph for the 'description' attribute
            'description' => fake()->paragraph(),
            // Generate a longer random paragraph for the 'long_description' attribute
            'long_description' => fake()->paragraph(7, true),
            // Generate a random boolean value for the 'completed' attribute
            'completed' => fake()->boolean(),
        ];
    }
}
