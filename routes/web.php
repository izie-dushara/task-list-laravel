<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Redirect root URL ('/') to the 'tasks.index' route
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Route to display a list of completed tasks at '/tasks'
Route::get('/tasks', function () {
    return view('index', [
        // Fetch tasks marked as completed, sorted by most recent
        'tasks' => \App\Models\Task::latest()->where('completed', true)->get(),
    ]);
})->name('tasks.index');

// Route to show the task creation form at '/tasks/create'
Route::view('/tasks/create', 'create')->name('tasks.create');

// Route to display a specific task by ID at '/tasks/{id}'
Route::get('/tasks/{id}', function ($id) {
    return view('show', [
        // Find task by ID or return a 404 if not found
        'task' => \App\Models\Task::findOrFail($id)
    ]);
})->name('tasks.show');

// Route to handle task creation form submission at '/tasks'
Route::post('/tasks', function (Request $request) {
    dd($request->all()); // Dump and die, displaying the request data
})->name('tasks.store');

// Fallback route for undefined URLs, displays a simple message
Route::fallback(function () {
    return 'Page not found';
});
