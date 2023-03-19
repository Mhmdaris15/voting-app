
<nav class="absolute left-1/2 transform -translate-x-1/2 flex justify-center items-center border-b-2 border-gray-600 mx-auto bg-transparent w-full px-2 sm:px-4 py-10 rounded dark:bg-gray-900">
    <div class="container flex justify-between items-center box-border px-0 border-gray-50" id="navbar">
      <a href="{{ url('/') }}" class="flex items-center ml-10 md:ml-0">
        <img src="{{ Vite::asset('resources/images/logo-kampak.png') }}" class="h-20 mr-3" alt="Logo SMKN 1 CIBINONG" />
        <img src="{{ Vite::asset('resources/images/logo-mppk.png') }}" class="h-20 mr-3" alt="Logo MPPK" />
        <img src="{{ Vite::asset('resources/images/logo-osis-removebg-preview.png') }}" class="h-20 mr-3" alt="Logo OSIS" />
        <div>
          <span class="self-center text-3xl font-bold whitespace-nowrap hidden lg:block text-white">PEMIRA 2023</span>
          <span class="self-center text-3xl font-bold whitespace-nowrap hidden lg:block text-white">SMKN 1 CIBINONG</span>
        </div>
      </a>
      <button data-collapse-toggle="navbar-default" type="button" class="inline-flex z-10 items-center p-2 ml-3 mr-10 md:mr-0 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
      </button>

      {{-- Make condition if user role is user and the url is /voting --}}
      @if(session('role') == 'user' && url()->current() == url('voting'))
        <div></div>
      @else
      <div class="absolute mt-48 hidden w-full md:static md:m-0 md:block md:w-auto px-9 z-[100]" id="navbar-default">
        <ul class="bg-gray-700 bg-opacity-80 md:bg-inherit flex flex-col mt-4 border sm:gap-x-2 md:gap-x-4 lg:gap-x-5 border-gray-100 rounded-lg md:flex-row md:mt-0 md:text-sm md:font-medium md:border-0">
          <a href="{{ url('/') }}" class="group md:px-8 py-4 flex justify-center items-center transition-all ease-in-out hover:shadow-xl hover:bg-red-200 md:hover:before:border-white md:before:border-transparent md:before:border-2 md:before:absolute md:before:inset-0 md:before:translate-x-2 md:before:translate-y-2 relative">
            <span class="block text-white rounded md:p-0 group-hover:text-black" aria-current="page">Home</span>
          </a>
          {{-- @if(Auth::user()->role == 'admin') --}}
          <a href="{{ url('dashboard') }}" class="group md:px-8 py-4 flex justify-center items-center transition-all ease-in-out hover:shadow-xl hover:bg-red-200 md:hover:before:border-white md:before:border-transparent md:before:border-2 md:before:absolute md:before:inset-0 md:before:translate-x-2 md:before:translate-y-2 relative">
            <span class="block text-white rounded md:p-0 group-hover:text-black" aria-current="page">Dashboard</span>
          </a>
          {{-- @endif --}}
          <a href="{{ url('voting') }}" class="group md:px-8 py-4 flex justify-center items-center transition-all ease-in-out hover:shadow-xl hover:bg-red-200 md:hover:before:border-white md:before:border-transparent md:before:border-2 md:before:absolute md:before:inset-0 md:before:translate-x-2 md:before:translate-y-2 relative">
            <span class="block text-white rounded md:p-0 group-hover:text-black" aria-current="page">Voting</span>
          </a>
          @guest
          <a href="{{ url('login') }}" class="group md:px-8 py-4 flex justify-center items-center transition-all ease-in-out hover:shadow-xl hover:bg-red-200 md:hover:before:border-white md:before:border-transparent md:before:border-2 md:before:absolute md:before:inset-0 md:before:translate-x-2 md:before:translate-y-2 relative">
            <span class="block text-white rounded md:p-0 group-hover:text-black" aria-current="page">Login</span>
          </a>
          @endguest
        </ul>
      </div>
      @endif
    </div>
  </nav>
