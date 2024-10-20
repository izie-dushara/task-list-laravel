<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), // Random name for the user
            'email' => fake()->unique()->safeEmail(), // Unique and safe random email
            'email_verified_at' => now(), // Set current timestamp for email verification
            'password' => static::$password ??= Hash::make('password'), // Hashed password (defaults to 'password')
            'remember_token' => Str::random(10), // Random token for "remember me" functionality
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null, // Set email_verified_at to null (unverified)
        ]);
    }
}
