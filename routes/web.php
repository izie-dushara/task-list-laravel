<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

// Redirect the root URL ('/') to the 'tasks.index' route
Route::get('/', function () {
    // Automatically redirects to the list of tasks
    return redirect()->route('tasks.index');
});

// Route to display all tasks at '/tasks'
Route::get('/tasks', function () {
    // Fetches all tasks ordered by creation date (newest first) and displays them
    return view('index', [
        'tasks' => Task::latest()->get(), // Alternative: 'Task::all()' fetches all tasks without ordering them
    ]);
})->name('tasks.index');

// Route to show the form for creating a task
Route::view('/tasks/create', 'create')->name('tasks.create');
// Alternative (commented-out) way with a callback function:
// Route::get('/tasks/create', function () {
//     return view('create');
// })->name('tasks.create');
// Explanation: The 'view' helper directly returns the view without needing a function, simplifying the route.

// Route to display the task edit form by its ID
Route::get('/tasks/{task}/edit', function (Task $task) {
    // Automatically finds and injects the task by its ID
    return view('edit', [
        'task' => $task // Passes the task to the view for editing
    ]);
})->name('tasks.edit');

// Route to display a specific task by its ID
Route::get('/tasks/{task}', function (Task $task) {
    // Automatically fetches the task by ID and passes it to the view
    return view('show', [
        'task' => $task // Pass the task to the view to display its details
    ]);
})->name('tasks.show');

// Route to handle task creation form submission
Route::post('/tasks', function (TaskRequest $request) {
    // TaskRequest automatically validates the form data before reaching this point
    $task = Task::create($request->validated()); // Alternative: Using manual field assignments
    /*
    // Alternative commented-out approach:
    // $data = $request->validated(); // Retrieve validated data
    // $task = new Task();
    // $task->title = $data['title']; // Assign the title
    // $task->description = $data['description']; // Assign the description
    // $task->long_description = $data['long_description']; // Assign the long description
    // $task->save(); // Save the task to the database
    */
    // Explanation: Task::create() is more concise and uses the fillable attributes.

    // Redirect to the newly created task's detail page with a success message
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

// Route to handle updating a task by its ID
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    // TaskRequest validates the update data
    $task->update($request->validated()); // Alternative: Manual updating of task fields
    /*
    // Alternative commented-out approach:
    // $data = $request->validated(); // Get validated data
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save(); // Save the updated task to the database
    */
    // Explanation: Using $task->update() is more concise and automatically handles mass-assignment.

    // Redirect to the task's detail page with a success message
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');

// Fallback route for undefined URLs
Route::fallback(function () {
    // Return a simple "Page not found" message for any invalid route
    return 'Page not found';
});
