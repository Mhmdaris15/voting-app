
<nav class="bg-transparent absolute w-full px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900">
    <div class="container flex flex-wrap items-center mx-auto">
      <a href="{{ url('/') }}" class="flex items-center">
          <img src="{{ Vite::asset('resources/images/logo-nevtik.png') }}" class="h-16 mr-3 sm:h-9" alt="NEVTIK Logo" />
          <span class="self-center text-xl font-bold whitespace-nowrap dark:text-white">NEVTIK SIP</span>
      </a>
      <div class="hidden w-full md:block md:w-auto px-9" id="navbar-default">
        <ul class="flex flex-col mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li class="w-32 h-10 flex justify-center items-center transition-all ease-in-out hover:shadow-md hover:shadow-orange-400 hover:bg-gradient-to-r hover:from-indigo-200 hover:via-red-200 hover:to-yellow-100">
            <a href="{{ url('/') }}" class="block text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white" aria-current="page">Home</a>
          </li>
          <li class="w-32 h-10 flex justify-center items-center transition-all ease-in-out hover:shadow-md hover:shadow-orange-400 hover:bg-gradient-to-r hover:from-indigo-200 hover:via-red-200 hover:to-yellow-100">
            <a href="{{ url('dashboard') }}" class="block text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Dashboard</a>
          </li>
          <li class="w-32 h-10 flex justify-center items-center transition-all ease-in-out hover:shadow-md hover:shadow-orange-400 hover:bg-gradient-to-r hover:from-indigo-200 hover:via-red-200 hover:to-yellow-100">
            <a href="{{ url('voting') }}" class="block text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Voting</a>
          </li>
          <li class="w-32 h-10 flex justify-center items-center transition-all ease-in-out hover:shadow-md hover:shadow-orange-400 hover:bg-gradient-to-r hover:from-indigo-200 hover:via-red-200 hover:to-yellow-100">
            <a href="#" class="block text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Pricing</a>
          </li>
          @guest
          <li class="w-32 h-10 flex justify-center items-center transition-all ease-in-out hover:shadow-md hover:shadow-orange-400 hover:bg-gradient-to-r hover:from-indigo-200 hover:via-red-200 hover:to-yellow-100">
            <a href="{{ url('login') }}" class="block text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Login</a>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
