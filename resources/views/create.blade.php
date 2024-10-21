@extends('layouts.app')

@section('title', 'Add Task')

@section('content')
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        {{-- CSRF token for security --}}

        <div>
            <label for="title">Title</label>
            {{-- Input field for the task title  --}}
            <input type="text" name="title" id="title">
        </div>

        <div>
            <label for="description">Descriptionk</label>
            {{-- Textarea for a short description of the task  --}}
            <textarea name="description" id="description" rows="5"></textarea>
        </div>

        <div>
            <label for="long_description">Long Description</label>
            {{-- Textarea for a longer, detailed description of the task  --}}
            <textarea name="long_description" id="long_description" rows="10"></textarea>
        </div>

        <div>
            {{-- Submit button to add the task  --}}
            <button type="submit">Add Task</button>
        </div>
    </form>
@endsection
