
<nav class="absolute left-1/2 transform -translate-x-1/2 flex justify-center items-center mx-auto bg-transparent w-full px-2 sm:px-4 py-10 rounded dark:bg-gray-900">
    <div class="container flex flex-wrap justify-between items-center box-border md:px-11 lg:px-36 border-gray-50">
      <a href="{{ url('/') }}" class="flex items-center">
          <img src="{{ Vite::asset('resources/images/logo-nevtik.png') }}" class="h-16 mr-3 sm:h-9" alt="NEVTIK Logo" />
          <span class="self-center text-xl font-bold whitespace-nowrap text-white">SMKN 1 CIBINONG</span>
      </a>
      <div class="hidden w-full md:block md:w-auto px-9" id="navbar-default">
        <ul class="flex flex-col mt-4 border sm:gap-x-2 md:gap-x-4 lg:gap-x-5 border-gray-100 rounded-lg md:flex-row md:mt-0 md:text-sm md:font-medium md:border-0">
          <li class="md:px-8 py-4 flex justify-center items-center rounded-full transition-all ease-in-out hover:shadow-xl hover:bg-red-200">
            <a href="{{ url('/') }}" class="block text-white rounded md:p-0 hover:text-black" aria-current="page">Home</a>
          </li>
          <li class="md:px-8 py-4 flex justify-center items-center rounded-full transition-all ease-in-out hover:shadow-xl hover:bg-red-200">
            <a href="{{ url('dashboard') }}" class="block text-white rounded md:border-0 md:p-0 hover:text-black">Dashboard</a>
          </li>
          <li class="md:px-8 py-4 flex justify-center items-center rounded-full transition-all ease-in-out hover:shadow-xl hover:bg-red-200">
            <a href="{{ url('voting') }}" class="block text-white rounded md:border-0 md:p-0 hover:text-black">Voting</a>
          </li>
          <li class="md:px-8 py-4 flex justify-center items-center rounded-full transition-all ease-in-out hover:shadow-xl hover:bg-red-200">
            <a href="#" class="block text-white rounded md:border-0 md:p-0 hover:text-black">Pricing</a>
          </li>
          @guest
          <li class="md:px-8 py-4 flex justify-center items-center rounded-full transition-all ease-in-out hover:shadow-xl hover:bg-red-200">
            <a href="{{ url('login') }}" class="block text-white rounded md:border-0 md:p-0 hover:text-black">Login</a>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
