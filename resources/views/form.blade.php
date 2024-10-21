@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('styles')
    <style>
        /* Styling for error messages */
        .error-message {
            color: red;
            font-size: 0.8rem;
        }
    </style>
@endsection

@section('content')
    {{-- Task editing form --}}

    <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
        @csrf
        {{-- CSRF token for security to prevent cross-site request forgery attacks --}}

        @isset($task)
            @method('PUT')
        @endisset
        <div>
            <label for="title">Title</label>
            {{-- Input field for entering the task's title --}}
            <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}">
            {{-- Display an error message if validation fails for the title --}}
            @error('title')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            {{-- Textarea for entering a short description of the task --}}
            <textarea name="description" id="description" rows="5">{{ $task->description ?? old('description') }}</textarea>
            {{-- Display an error message if validation fails for the description --}}
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="long_description">Long Description</label>
            {{-- Textarea for entering a detailed, longer description of the task --}}
            <textarea name="long_description" id="long_description" rows="10">{{ $task->long_description ?? old('long_description') }}</textarea>
            {{-- Display an error message if validation fails for the long description --}}
            @error('long_description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            {{-- Submit button to update the task --}}
            <button type="submit">
                @isset($task)
                    Update Task
                @else
                    Add Task
                @endisset
            </button>
        </div>
    </form>
@endsection
