@extends('layouts.main')

@section('content')
    
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<form action="{{ url('login') }}" method="post">
@csrf
<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
<div class="w-full max-w-md space-y-8">
  <div>
    <img class="mx-auto h-32 w-auto" src="{{ Vite::asset('resources/images/logo-nevtik.png') }}" alt="Your Company">
    <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
    <p class="mt-2 text-center text-sm text-gray-600">
      Or
      <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">start your 14-day free trial</a>
    </p>
  </div>
  <form class="mt-8 space-y-6" action="#" method="POST">
    {{-- <input type="hidden" name="remember" value="true"> --}}
    <div class="-space-y-px rounded-md shadow-sm">
      <div>
        <label for="email-address" class="sr-only">Email address</label>
        <input id="email-address" name="email" type="email" autocomplete="email" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 p-3 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Email address">
      </div>
      {{-- <div>
        <label for="nisn" class="sr-only">NISN</label>
        <input id="nisn" name="nisn" type="text" autocomplete="nisn" min="9" max="10" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 p-3 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="NISN">
      </div> --}}
      <div>
        <label for="password" class="sr-only">Password</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 p-3 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Password">
      </div>

      {{-- Error --}}
      @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ $errors->first() }}</span>
      </div>
      @endif
    </div>

    <div class="flex items-center justify-between">
      <div class="flex items-center">
        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" value="1">
        <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
      </div>

      <div class="text-sm">
        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot your password?</a>
      </div>
    </div>

    <div>
      <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
          <!-- Heroicon name: mini/lock-closed -->
          <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
          </svg>
        </span>
        Sign in
      </button>
    </div>
  </form>
</div>
</div>
</form>

    
@endsection