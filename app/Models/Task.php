<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Using 'fillable' to define which attributes can be mass-assigned
    protected $fillable = ['title', 'description', 'long_description'];

    // Alternatively, you can use 'guarded' to specify which attributes can't be mass-assigned
    // protected $guarded = ['secret'];
}
