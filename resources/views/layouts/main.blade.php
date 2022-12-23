<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    @include('partials.navbar')
    {{-- @if (Auth::check())
        @include('partials.sidebar')
    @endif --}}
    @yield('content')
    @vite('resources/js/app.js')
    @vite('resources/js/flowbite.js')
</body>
</html>