<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;

// Define a Task class that models a task object
class Task
{
    // Constructor method automatically assigns the properties when an object is instantiated
    public function __construct(
        public int $id,                  // Task ID (must be an integer)
        public string $title,            // Title of the task
        public string $description,      // Short description of the task
        public ?string $long_description, // Long description (optional, can be null)
        public bool $completed,          // Whether the task is completed (true or false)
        public string $created_at,       // Date and time the task was created
        public string $updated_at        // Date and time the task was last updated
    ) {}
}

// Create an array of Task objects
$tasks = [
    // First task
    new Task(
        1,                              // ID: 1
        'Buy groceries',                // Title: Buy groceries
        'Task 1 description',           // Short description: Task 1 description
        'Task 1 long description',      // Long description: Task 1 long description
        false,                          // Task is not completed
        '2023-03-01 12:00:00',          // Creation date
        '2023-03-01 12:00:00'           // Last update date
    ),
    // Second task
    new Task(
        2,                              // ID: 2
        'Sell old stuff',               // Title: Sell old stuff
        'Task 2 description',           // Short description: Task 2 description
        null,                           // No long description (null)
        false,                          // Task is not completed
        '2023-03-02 12:00:00',          // Creation date
        '2023-03-02 12:00:00'           // Last update date
    ),
    // Third task
    new Task(
        3,                              // ID: 3
        'Learn programming',            // Title: Learn programming
        'Task 3 description',           // Short description: Task 3 description
        'Task 3 long description',      // Long description: Task 3 long description
        true,                           // Task is completed
        '2023-03-03 12:00:00',          // Creation date
        '2023-03-03 12:00:00'           // Last update date
    ),
    // Fourth task
    new Task(
        4,                              // ID: 4
        'Take dogs for a walk',         // Title: Take dogs for a walk
        'Task 4 description',           // Short description: Task 4 description
        null,                           // No long description (null)
        false,                          // Task is not completed
        '2023-03-04 12:00:00',          // Creation date
        '2023-03-04 12:00:00'           // Last update date
    ),
];

// Define a route that responds to the root URL ('/')
// It redirects the user to the 'tasks.index' route
Route::get('/', function () {
    // Redirect to the tasks listing route
    return redirect()->route('tasks.index');
});

// Define a route that responds to '/tasks'
// This will render the 'index' view and pass the $tasks array
Route::get('/tasks', function () use ($tasks) {
    // Render the 'index' view, passing the tasks data to it
    return view('index', [
        'tasks' => $tasks
    ]);
})->name('tasks.index'); // Name this route 'tasks.index'

// Define a route that responds to '/tasks/{id}'
// It retrieves a specific task by ID from the $tasks array and displays it in the 'show' view
Route::get('/tasks/{id}', function ($id) use ($tasks) {
    // Convert the $tasks array into a collection to use the 'firstWhere' method
    // This finds the first task where the 'id' matches the provided $id
    $task = collect($tasks)->firstWhere('id', $id);

    // If no task with the given ID is found, abort with a 404 error
    if (!$task) {
        abort(Response::HTTP_NOT_FOUND); // Return a 404 Not Found error
    }

    // Render the 'show' view and pass the found task
    return view('show', ['task' => $task]);
})->name('tasks.show'); // Name this route 'tasks.show'

// Define a fallback route for undefined URLs
// If the user visits a URL that doesn't match any defined routes, return a simple message
Route::fallback(function () {
    return 'Still got somewhere';
});
