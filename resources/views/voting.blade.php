@extends('layouts.main')

@section('content')

<!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/aspect-ratio'),
    ],
  }
  ```
-->
<div class="bg-white">
    <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
      <h2 class="sr-only">Products</h2>
      {{-- get the name and NISN of the user --}}
      <p class="text-2xl font-extrabold text-gray-900 mb-5">Hello, {{ $user->name }} ({{ $user->nisn }})</p>
      @if (empty(Auth::user()->candidate_id))
        <p class="w-auto py-2 px-4 rounded-xl inline-block border-dotted border-black border-4 text-2xl font-extrabold bg-red-500 text-gray-900 mb-5">You haven't voted yet</p>
       @else 
        <p class="w-auto py-2 px-4 rounded-xl inline-block border-dotted border-black border-4 text-2xl font-extrabold bg-green-500 text-gray-100 mb-5">Your vote is {{ Auth::user()->candidate_id }}</p>
      
          
      @endif
      <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
        
        @foreach ($candidates as $candidate)
            
        <form action="{{ url('voting') }}/{{ $candidate->id }}" method="post">
          @csrf
          <a href="{{ url('voting') }}/{{ $candidate->id }}" class="group">
            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
              <img src="{{ Vite::asset('resources/images/'.$candidate->photo) }}" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="h-full w-full object-cover object-center group-hover:opacity-75">
            </div>
            <h3 class="mt-4 text-sm text-gray-700">{{ $candidate->name }}</h3>
            {{-- <p class="mt-1 text-lg font-medium text-gray-900">Count : {{ $candidate->votes }}</p> --}}
            <p class="mt-1 text-lg font-medium text-gray-900">Count : {{ $candidate->users->count() }}</p>
            <p>Percentage : {{ $candidate->users->count() / $n_users * 100}} %</p>
          </a>
          <button type="submit" class="my-3 py-1 px-4 bg-red-600 text-white rounded-3xl hover:bg-red-400 hover:text-black hover:font-bold">
            Vote
          </button>
        </form>

        @endforeach

  
        <!-- More products... -->
      </div>
      {{-- Statistics --}}
      <h3 class="text-3xl font-bold mt-4 hover:text-red-700 shadow cursor-pointer">Live Statistics</h3>
      <p>Who haven't voted yet : {{ $n_not_voted }} </p>

    </div>
  </div>    

@endsection