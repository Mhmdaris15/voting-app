<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VotingApp | @yield('title')</title>
    <link rel="icon" href="{{ Vite::asset('resources/images/logo-nevtik.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
</head>
<body class="h-screen bg-gradient-to-r from-indigo-400 to-cyan-400 bg-repeat-round">
    @include('partials.navbar')
    {{-- @if (Auth::check())
        @include('partials.sidebar')
    @endif --}}
    @yield('content')
    @vite('resources/js/app.js')
    @vite('resources/js/jquery-3.6.3.slim.min.js')
    @vite('resources/js/flowbite.js')
    @vite('resources/js/chart.js')
    @stack('scripts')
</body>
</html>
