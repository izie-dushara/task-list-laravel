<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Using 'fillable' to define which attributes can be mass-assigned
    protected $fillable = ['title', 'description', 'long_description'];

    // Method to toggle the 'completed' status of a task
    public function toggleComplete()
    {
        // Toggle the 'completed' attribute by negating its current value
        $this->completed = !$this->completed;

        // Save the updated task back to the database
        $this->save();
    }

    // Alternatively, you can use 'guarded' to specify which attributes can't be mass-assigned
    // This is useful if you want to prevent specific fields from being modified via mass assignment
    // protected $guarded = ['secret'];
}
