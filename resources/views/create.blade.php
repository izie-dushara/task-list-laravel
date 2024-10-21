@extends('layouts.app')

@section('title', 'Add Task')

@section('styles')
    <style>
        /* Styling for error messages */
        .error-message {
            color: red;
        }
    </style>
@endsection

@section('content')
    {{-- Task creation form --}}

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        {{-- CSRF token for security to prevent cross-site request forgery attacks --}}

        <div>
            <label for="title">Title</label>
            {{-- Input field for entering the task's title --}}
            <input type="text" name="title" id="title">
            {{-- Display an error message if validation fails for the title --}}
            @error('title')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            {{-- Textarea for entering a short description of the task --}}
            <textarea name="description" id="description" rows="5"></textarea>
            {{-- Display an error message if validation fails for the description --}}
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="long_description">Long Description</label>
            {{-- Textarea for entering a detailed, longer description of the task --}}
            <textarea name="long_description" id="long_description" rows="10"></textarea>
            {{-- Display an error message if validation fails for the long description --}}
            @error('long_description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            {{-- Submit button to create the task --}}
            <button type="submit">Add Task</button>
        </div>
    </form>
@endsection
