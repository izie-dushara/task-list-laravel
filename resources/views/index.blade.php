@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
    <nav class="mb-4">
        <a href="{{ route('tasks.create') }}" class="link">Add Task!</a>
    </nav>
    {{-- The @forelse directive iterates over $tasks, similar to @foreach, but it also handles the case where the array is empty. --}}
    @forelse ($tasks as $task)
        <div>
            {{-- Create a clickable link for each task that leads to the route 'tasks.show' and passes the task ID as a parameter --}}
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}" @class(['line-through' => $task->completed])>
                {{-- Display the title of the task --}}
                {{ $task->title }}
            </a>
        </div>
        {{-- @empty handles the case where the $tasks array is empty. If there are no tasks, this block will be executed. --}}
    @empty
        <div>There are no tasks!</div>
    @endforelse

    {{-- If there are tasks, display pagination links --}}
    @if ($tasks->count())
        <nav class="mt-4">{{ $tasks->links() }}</nav>
    @endif

@endsection
