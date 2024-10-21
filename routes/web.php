<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Redirect the root URL ('/') to the 'tasks.index' route
Route::get('/', function () {
    // Redirect to the route that shows the list of tasks
    return redirect()->route('tasks.index');
});

// Route to display a list of tasks at '/tasks'
Route::get('/tasks', function () {
    return view('index', [
        // Fetch all tasks, ordered by creation date (newest first)
        'tasks' => Task::latest()->get(),
    ]);
})->name('tasks.index');

// Route to show the task creation form at '/tasks/create'
Route::view('/tasks/create', 'create')->name('tasks.create');

// Route to display a specific task by its ID at '/tasks/{id}'
Route::get('/tasks/{id}', function ($id) {
    return view('show', [
        // Find the task by its ID or throw a 404 error if it doesn't exist
        'task' => Task::findOrFail($id)
    ]);
})->name('tasks.show');

// Route to show the task edit form by its ID at '/tasks/{id}/edit'
Route::get('/tasks/{id}/edit', function ($id) {
    return view('edit', [
        // Find the task by its ID or throw a 404 error if it doesn't exist
        'task' => Task::findOrFail($id)
    ]);
})->name('tasks.edit');

// Route to handle form submissions for creating a new task at '/tasks'
Route::post('/tasks', function (Request $request) {
    // Validate the submitted form data
    $data = $request->validate([
        'title' => 'required|max:255',         // Ensure the title is present and has a maximum length of 255 characters
        'description' => 'required',           // Ensure a description is provided
        'long_description' => 'required',      // Ensure a detailed description is provided
    ]);

    // Create a new task with the validated data
    $task = new Task();
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    // Save the task to the database
    $task->save();

    // Redirect to the newly created task's page, with a success message
    return redirect()->route('tasks.show', ['id' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

// Route to handle updating a specific task by its ID at '/tasks/{id}'
Route::put('/tasks/{id}', function ($id, Request $request) {
    // Validate the submitted form data
    $data = $request->validate([
        'title' => 'required|max:255',         // Ensure the title is present and has a maximum length of 255 characters
        'description' => 'required',           // Ensure a description is provided
        'long_description' => 'required',      // Ensure a detailed description is provided
    ]);

    // Find the task by its ID and update it with the validated data
    $task = Task::findOrFail($id);
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    // Save the updated task to the database
    $task->save();

    // Redirect to the updated task's page, with a success message
    return redirect()->route('tasks.show', ['id' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');

// Fallback route for any undefined URLs
// Returns a "Page not found" message for invalid routes
Route::fallback(function () {
    return 'Page not found';
});
