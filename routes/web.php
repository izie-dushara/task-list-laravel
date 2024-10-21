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

// Route to show the task edit form by its ID at '/tasks/{task}/edit'
Route::get('/tasks/{task}/edit', function (Task $task) {
    // Display the edit view with the task found by ID
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');

// Route to display a specific task by its ID at '/tasks/{task}'
Route::get('/tasks/{task}', function (Task $task) {
    // Show a single task's details by its ID
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

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

    // Redirect to the newly created task's page with a success message
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

// Route to handle updating a specific task by its ID at '/tasks/{task}'
Route::put('/tasks/{task}', function (Task $task, Request $request) {
    // Validate the submitted form data
    $data = $request->validate([
        'title' => 'required|max:255',         // Ensure the title is present and has a maximum length of 255 characters
        'description' => 'required',           // Ensure a description is provided
        'long_description' => 'required',      // Ensure a detailed description is provided
    ]);

    // Update the task with the validated data
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    // Save the updated task to the database
    $task->save();

    // Redirect to the updated task's page with a success message
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');

// Fallback route for undefined URLs
Route::fallback(function () {
    // Return a simple "Page not found" message for invalid routes
    return 'Page not found';
});
