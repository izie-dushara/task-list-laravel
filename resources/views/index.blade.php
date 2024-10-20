@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
    {{--
    Alternative code using an @if statement:
    This code checks if the $tasks array has any elements.
    If the count of $tasks is greater than zero, it will execute the block of code within the @if.
    This is an alternative to @forelse, which we will explain below.

    @if (count($tasks))
    --}}

    {{-- The @forelse directive iterates over $tasks, similar to @foreach, but it also handles the case where the array is empty. --}}
    @forelse ($tasks as $task)
        <div>
            {{-- Create a clickable link for each task that leads to the route 'tasks.show' and passes the task ID as a parameter --}}
            <a href="{{ route('tasks.show', ['id' => $task->id]) }}">
                {{-- Display the title of the task --}}
                {{ $task->title }}
            </a>
        </div>
        {{-- @empty handles the case where the $tasks array is empty. If there are no tasks, this block will be executed. --}}
    @empty
        <div>There are no tasks!</div>
    @endforelse

    {{--
    End of the alternative code using @if.
    In this approach, you would manually handle displaying the empty state (i.e., no tasks).
    @endif
    --}}
@endsection
