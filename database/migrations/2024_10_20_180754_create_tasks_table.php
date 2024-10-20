<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Define a new migration class that extends the Migration class
return new class extends Migration
{
    /**
     * Run the migrations.
     * This method is called when the migration is executed.
     */
    public function up(): void
    {
        // Create a new 'tasks' table in the database
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Create an auto-incrementing primary key column 'id'

            $table->string('title'); // Create a column 'title' for task titles (string type)
            $table->text('description'); // Create a column 'description' for task descriptions (text type)
            $table->text('long_description')->nullable(); // Create a nullable column 'long_description' for detailed descriptions
            $table->boolean('completed')->default(false); // Create a boolean column 'completed' to indicate if the task is done, defaulting to false

            $table->timestamps(); // Create 'created_at' and 'updated_at' timestamp columns
        });
    }

    /**
     * Reverse the migrations.
     * This method is called when the migration is rolled back.
     */
    public function down(): void
    {
        // Drop the 'tasks' table if it exists
        Schema::dropIfExists('tasks');
    }
};
