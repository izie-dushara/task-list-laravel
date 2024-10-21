<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Laravel Task List App</title>
    {{-- Page title section that can be replaced in child views --}}

    {{-- Placeholder for custom styles defined in child views --}}
    @yield('styles')
</head>
<body>
    {{-- This section will be replaced with the content from the 'title' section in child views --}}
    <h1>@yield('title')</h1>

    <div>
        {{-- Display a success message if it exists in the session --}}
        @if (session()->has('success'))
            <div>{{ session('success') }}</div>
        @endif

        {{-- This section will be replaced with the content from the 'content' section in child views --}}
        @yield('content')
    </div>
</body>
</html>
