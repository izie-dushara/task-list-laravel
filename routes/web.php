<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Redirect the root URL ('/') to the 'tasks.index' route
Route::get('/', function () {
    // Redirect to the route that shows a list of completed tasks
    return redirect()->route('tasks.index');
});

// Route to display a list of completed tasks at '/tasks'
Route::get('/tasks', function () {
    return view('index', [
        // Retrieve all tasks marked as completed, ordered by creation date (most recent first)
        'tasks' => Task::latest()->where('completed', true)->get(),
    ]);
})->name('tasks.index');

// Route to show the task creation form at '/tasks/create'
Route::view('/tasks/create', 'create')->name('tasks.create');

// Route to display a specific task by its ID at '/tasks/{id}'
Route::get('/tasks/{id}', function ($id) {
    return view('show', [
        // Look up the task by its ID, throw a 404 error if the task doesn't exist
        'task' => Task::findOrFail($id)
    ]);
})->name('tasks.show');

// Route to handle form submissions for creating a new task at '/tasks'
Route::post('/tasks', function (Request $request) {
    // Validate incoming form data to ensure required fields are filled and within limits
    $data = $request->validate([
        'title' => 'required|max:255',          // Title is required and cannot exceed 255 characters
        'description' => 'required',            // Short description is required
        'long_description' => 'required',       // Long description is required
    ]);

    // Create a new task instance and fill it with validated form data
    $task = new Task();
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    // Save the new task to the database
    $task->save();

    // Redirect to the specific task's page after saving it successfully
    return redirect()->route('tasks.show', ['id' => $task->id]);
})->name('tasks.store');

// Fallback route for any undefined URLs
// Returns a custom "Page not found" message
Route::fallback(function () {
    return 'Page not found';
});
