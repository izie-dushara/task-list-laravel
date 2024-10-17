<?php

use Illuminate\Support\Facades\Route;

// Defines a route for the root URL ('/'). When accessed, it returns the 'index' view.
// The 'index' view is provided with two variables: 'name' and 'nameHtml'.
// The 'name' variable will be displayed with escaped output (to prevent HTML injection).
// The 'nameHtml' variable contains a string with HTML that will be escaped when printed using Blade syntax.
Route::get('/', function () {
    return view('index', [
        'name' => 'Izie',
        // This contains HTML that will be escaped when displayed.
        'nameHtml' => 'Izie</br>'
    ]);
});

// Defines a route for '/xxx'. When accessed, it returns 'hello'.
// The route is also named 'hello', which can be referenced using route('hello').
Route::get('/xxx', function () {
    return 'hello';
})->name('hello');

// Defines a dynamic route with a placeholder '{name}' in the URL.
// When accessed, it takes the 'name' from the URL and returns a greeting 'Hello {name}!'
Route::get('/greet/{name}', function ($name) {
    return 'Hello ' . $name . '!';
});

// Defines a route for '/halo'. When accessed, it redirects the user to the route named 'hello' (which points to '/xxx').
Route::get('halo', function(){
    return redirect()->route('hello');
});

// A fallback route that handles all requests that don't match any of the above routes.
// If the user visits a URL that hasn't been defined, it returns 'Still got somewhere'.
Route::fallback(function() {
    return 'Still got somewhere';
});

// GET: Used to retrieve data (displaying resources like pages, or pulling data from an API).
// POST: Used to submit data (e.g., form submission, creating new records).
// PUT: Used to update existing resources (replaces all current representations with new data).
// DELETE: Used to delete existing resources.
