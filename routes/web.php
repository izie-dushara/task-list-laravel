<?php

use Illuminate\Support\Facades\Route;

// Route for the root URL ('/') that redirects to the 'tasks.index' route
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Route for '/tasks' to display a list of completed tasks
Route::get('/tasks', function () {
    return view('index', [
        // Fetch only the tasks marked as completed, sorted by the latest
        'tasks' => \App\Models\Task::latest()->where('completed', true)->get(),
    ]);
})->name('tasks.index'); // Name this route 'tasks.index'

// Route for '/tasks/{id}' to display a specific task by ID
Route::get('/tasks/{id}', function ($id) {
    return view('show', [
        // Find the task by its ID or throw a 404 if not found
        'task' => \App\Models\Task::findOrFail($id)
    ]);
})->name('tasks.show'); // Name this route 'tasks.show'

// Fallback route for undefined URLs, displays a simple message
Route::fallback(function () {
    return 'Still got somewhere';
});
