<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- blade-formatter-disable --}}
    <style type="text/tailwindcss">
        .btn {
            @apply rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/10 hover:bg-slate-50 text-slate-700
        }

        .link {
            @apply font-medium text-gray-700 underline decoration-pink-500
        }

        label {
            @apply block uppercase text-slate-700 mb-2
        }

        input, textarea {
            @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none
        }

        .error {
            @apply text-red-500 text-sm
        }
    </style>
    {{-- blade-formatter-enable --}}

    <title>Laravel Task List App</title>
    {{-- Page title section that can be replaced in child views --}}
    {{-- Placeholder for custom styles defined in child views --}}
    @yield('styles')
</head>

<body class=" container mx-auto my-10 max-w-lg">
    {{-- This section will be replaced with the content from the 'title' section in child views --}}
    <h1 class="text-2xl mb-4">@yield('title')</h1>

    <div x-data="{ flash: true }">
        {{-- Display a success message if it exists in the session --}}
        @if (session()->has('success'))
        <div x-show="flash"
            class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700"
            role="alert">
            <strong class="font-bold">Success!</strong>
            <div>
                {{ session('success') }}
            </div>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6 cursor-pointer" @click="flash = false">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
        </div>
        @endif

        {{-- This section will be replaced with the content from the 'content' section in child views --}}
        @yield('content')
    </div>
</body>

</html>
