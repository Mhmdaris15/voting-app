@extends('layouts.main')

@section('title', 'Login Page')

@section('content')

<img class="absolute left-[10%] top-[40%] md:left-[40%] z-0" src="{{ Vite::asset('/resources/images/png-assets/Tech Life - Blockchain.png') }}" alt="Blockchain">
<div class="absolute w-full flex justify-around items-center top-52 gap-x-64 invisible md:visible">
  <img class="w-60 xl:w-auto" src="{{ Vite::asset('/resources/images/png-assets/taxi-design.gif') }}" alt="Taxi Design">
  <img class="w-60 xl:w-auto" src="{{ Vite::asset('/resources/images/png-assets/taxi-data-science-graphs-floating-from-laptop.gif') }}" alt="Taxi Delivery">

</div>
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<form action="{{ url('login') }}" method="post">
@csrf
<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
<div class="w-full max-w-md space-y-8 mt-28 z-10">
  <div>
    {{-- Toast --}}
    @if(session('error'))
    <div id="toast-default" class="flex mt-20 md:mt-0 md:mb-3 mx-auto items-center p-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
      <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-blue-500 bg-blue-100 rounded-lg dark:bg-blue-800 dark:text-blue-200">
          <svg aria-hidden="true" class="w-5 h-5" fill="red" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Fire icon</span>
      </div>
      {{-- Get session error --}}
      <div class="ml-3 text-sm font-normal">{{ session('error') }}</div>
      <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-default" aria-label="Close">
          <span class="sr-only">Close</span>
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      </button>
  </div>
    @endif
  {{-- End Toast --}}
    <img class="mx-auto h-32 w-auto" src="{{ Vite::asset('resources/images/logo-kampak.png') }}" alt="Your Company">
    <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-100">Sign in to your account</h2>
    <p class="mt-2 text-center text-sm text-gray-600">
      Or
      <a href="https://wa.me/+6285814045755" target="_blank" class="font-medium text-indigo-600 hover:text-indigo-500">Contact The Admin if you haven't registered.</a>
    </p>
  </div>
  <form class="mt-8 space-y-6" action="#" method="POST" class="">
    {{-- <input type="hidden" name="remember" value="true"> --}}
    <div class="-space-y-px rounded-md shadow-sm">
      <div>
        <label for="email-address" class="sr-only">Email address</label>
        <input id="email-address" name="email" type="email" autocomplete="email" required class="relative opacity-80 block w-full appearance-none rounded-none rounded-t-md border border-gray-300 p-3 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Email address">
      </div>
      {{-- <div>
        <label for="nisn" class="sr-only">NISN</label>
        <input id="nisn" name="nisn" type="text" autocomplete="nisn" min="9" max="10" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 p-3 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="NISN">
      </div> --}}
      <div>
        <label for="password" class="sr-only">Password</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required class="relative opacity-80 block w-full appearance-none rounded-none rounded-b-md border border-gray-300 p-3 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Password">
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
<svg class="absolute bottom-0 z-[-1] opacity-90 xl:invisible sm:visible" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#000b76" fill-opacity="1" d="M0,128L40,112C80,96,160,64,240,58.7C320,53,400,75,480,106.7C560,139,640,181,720,208C800,235,880,245,960,245.3C1040,245,1120,235,1200,192C1280,149,1360,75,1400,37.3L1440,0L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
<svg class="absolute bottom-0 z-[-1] opacity-90 invisible xl:visible" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#000b76" fill-opacity="1" d="M0,160L20,160C40,160,80,160,120,160C160,160,200,160,240,181.3C280,203,320,245,360,256C400,267,440,245,480,213.3C520,181,560,139,600,128C640,117,680,139,720,165.3C760,192,800,224,840,245.3C880,267,920,277,960,272C1000,267,1040,245,1080,202.7C1120,160,1160,96,1200,106.7C1240,117,1280,203,1320,224C1360,245,1400,203,1420,181.3L1440,160L1440,320L1420,320C1400,320,1360,320,1320,320C1280,320,1240,320,1200,320C1160,320,1120,320,1080,320C1040,320,1000,320,960,320C920,320,880,320,840,320C800,320,760,320,720,320C680,320,640,320,600,320C560,320,520,320,480,320C440,320,400,320,360,320C320,320,280,320,240,320C200,320,160,320,120,320C80,320,40,320,20,320L0,320Z"></path></svg>
@endsection
