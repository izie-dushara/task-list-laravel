<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create(); // Create 10 random users
        User::factory(2)->unverified()->create(); // Create 2 unverified users
        Task::factory(20)->create(); // Create 20 random tasks

        User::factory()->create([
            'name' => 'Test User', // Create a user with a specific name
            'email' => 'test@example.com', // Assign a specific email
        ]);
    }
}
