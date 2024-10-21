<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

// Redirect the root URL ('/') to the 'tasks.index' route
Route::get('/', function () {
    // Redirect to the route that shows the list of tasks
    return redirect()->route('tasks.index');
});

// Route to display a list of tasks at '/tasks'
Route::get('/tasks', function () {
    return view('index', [
        // Fetch all tasks from the database, ordered by creation date (newest first)
        'tasks' => Task::latest()->get(),
    ]);
})->name('tasks.index');

// Route to show the task creation form at '/tasks/create'
Route::view('/tasks/create', 'create')->name('tasks.create');
// The 'view' helper directly returns the 'create' view for displaying the task creation form

// Route to show the task edit form by its ID at '/tasks/{task}/edit'
Route::get('/tasks/{task}/edit', function (Task $task) {
    // The 'Task' model is automatically injected, so the task is found by its ID
    return view('edit', [
        'task' => $task // Pass the task to the view for editing
    ]);
})->name('tasks.edit');

// Route to display a specific task by its ID at '/tasks/{task}'
Route::get('/tasks/{task}', function (Task $task) {
    // The 'Task' model is automatically injected, fetching the task based on the ID
    return view('show', [
        'task' => $task // Pass the task to the view to display its details
    ]);
})->name('tasks.show');

// Route to handle form submissions for creating a new task at '/tasks'
Route::post('/tasks', function (TaskRequest $request) {
    // 'TaskRequest' automatically handles validation using the rules defined in the class
    $data = $request->validated(); // Retrieve the validated data

    // Create a new task using the validated data
    $task = new Task();
    $task->title = $data['title']; // Assign the title
    $task->description = $data['description']; // Assign the description
    $task->long_description = $data['long_description']; // Assign the long description

    // Save the task to the database
    $task->save();

    // Redirect to the task's show page with a success message after creation
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

// Route to handle updating a specific task by its ID at '/tasks/{task}'
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    // 'TaskRequest' validates the update data similarly to the store process
    $data = $request->validated(); // Get the validated data

    // Update the task with the new validated data
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    // Save the updated task back to the database
    $task->save();

    // Redirect to the task's show page with a success message after the update
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');

// Fallback route for undefined URLs
Route::fallback(function () {
    // Return a simple "Page not found" message for invalid routes
    return 'Page not found';
});
