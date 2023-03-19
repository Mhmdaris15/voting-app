@extends('layouts.main')

@section('title', 'Voting Page')

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
{{-- <img class="absolute left-32 z-[1]" src="{{ Vite::asset('/resources/images/png-assets/Moneyverse - Crypto Galaxy.png') }}" alt="Crypto Galaxy"> --}}
<div class="h-auto pt-40 md:pt-20">
  
    <div class="mx-auto max-w-2xl py-5 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
      {{-- <h2 class="sr-only">Products</h2> --}}
      {{-- get the name and NISN of the user --}}
      <form action="{{ url('logout') }}" method="post">
        @csrf
        <div class="flex justify-between items-center">
          <p class="text-2xl font-extrabold text-gray-50 mb-5">Hello, {{ $user->name }} ({{ $user->nisn }})</p>
          <button type="submit" class="logout py-2 px-4 bg-orange-600 inline-block text-gray-100 rounded hover:bg-orange-400 hover:text-gray-50 hover:cursor-pointer">Logout</button>
        </div>
      </form>
      <div class="flex justify-between items-center">
        @if (empty(Auth::user()->candidate_id))
          <p class="w-auto py-2 px-4 rounded-md shadow-lg shadow-gray-400 inline-block text-2xl font-extrabold bg-[#ff6992] text-gray-900 mb-5">You haven't voted yet</p>
        @else
          <p class="w-auto py-2 px-4 rounded-md shadow-lg shadow-gray-400 inline-block text-2xl font-extrabold bg-green-500 text-gray-100 mb-5">Your vote is {{ Auth::user()->candidate_id }}</p>
        @endif
        
        {{-- Modal Add Candidate --}}
        
        <!-- Modal toggle -->
        @if(Auth::user()->role == 'admin')
        <button data-modal-target="add-candidate-modal" data-modal-toggle="add-candidate-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
          Add Candidate
        </button>
        @endif
      </div>


      <!-- Main modal -->
      <div id="add-candidate-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
          <div class="relative w-full h-full max-w-md md:h-auto">
              <!-- Modal content -->
              <div class="relative bg-[#fff9f4] rounded-lg shadow dark:bg-gray-700">
                  <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="add-candidate-modal">
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                      <span class="sr-only">Close modal</span>
                  </button>
                  <div class="px-6 py-6 lg:px-8">
                      <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h3>
                      <form class="space-y-6" action="{{ url('voting') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="all_missions" id="all_missions">
                          <div>
                              <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Candidate Name</label>
                              <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Joko Widodo" required>
                          </div>
                          <div>
                            <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Candidate Photo</label>
                            <input type="file" name="photo" id="photo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help">
                          </div>
                          <div>
                            <label for="vision" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Candidate's Vision</label>
                            <input type="text" name="vision" id="vision" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Create a great event" required>
                          </div>
                          <div>
                            <label for="missions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Candidate's Mission</label>
                            {{-- <input type="text" name="mission" id="mission" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Create a great event" required> --}}
                            <div id="mission_fields">
                              <button type="button" id="add_mission_field" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Add Mission</button>
                              <input type="text" name="missions[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            </div>
                          </div>
                          
                          <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add New Candidate</button>
                          
                      </form>
                  </div>
              </div>
          </div>
      </div> 



      <div class="grid grid-cols-1 mx-auto gap-y-10 gap-x-9 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
        
        @foreach ($candidates as $candidate)

        <form class="p-5 relative flex flex-col justify-between items-start rounded-xl shadow-lg shadow-yellow-100 bg-gradient-to-r from-indigo-200 via-red-200 to-yellow-100" action="{{ url('voting') }}/{{ $candidate->id }}" method="post">
          @csrf
          <div class="cursor-pointer" data-modal-toggle="{{ $candidate->name }}" class="group">
            <div class="overflow-hidden rounded-lg bg-gray-200">
              <img src="{{ Vite::asset('resources/images/'.$candidate->photo) }}" alt="{{ $candidate->name }}" class="w-96 h-56 object-cover object-center group-hover:opacity-75">
            </div>
            <h3 class="my-4 text-xl font-bold text-gray-700">{{ $candidate->name }}</h3>
            {{-- <p class="mt-1 text-lg font-medium text-gray-900">Count : {{ $candidate->votes }}</p> --}}
            {{-- @if($user->role == 'admin')
              <p class="mt-1 text-lg font-medium text-gray-900">Count : {{ $candidate->users->count() }}</p>
              <p>Percentage : {{ $candidate->users->count() / $n_users * 100}} %</p>
            @endif --}}
          </div>
          <div class="absolute bottom-5 right-4 flex justify-center items-center gap-x-2">
            {{-- <div><img src="https://img.icons8.com/sf-ultralight/25/null/pencil.png"/></div> --}}
            @if($user->role == 'admin')
            <button type="button" class="bg-red-500 px-5 py-2 rounded-md shadow-sm shadow-gray-600 transition-all ease-in-out hover:bg-red-200" data-modal-toggle="delete-modal-{{ $candidate->id }}"><img src="https://img.icons8.com/material-outlined/24/null/delete-trash.png"/></button>
            @endif
          </div>
          
          <!-- Main modal -->
          <div id="{{ $candidate->name }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-2xl md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-[#fff9f4] rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                          {{ $candidate->name }}
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="{{ $candidate->name }}">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->

                    <div class="m-auto my-5 max-w-sm bg-[#fff9f4] border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                      <a href="#" class="">
                          <img class="rounded-t-lg" src="{{ Vite::asset('resources/images/'.$candidate->photo) }}" alt="" />
                      </a>
                      <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Visi</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $candidate->vision }}</p>
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Misi</h5>
                            @php
                              $missions = json_decode($candidate->missions);
                            @endphp
                        @foreach ($missions as $mission)
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $mission }}</p>
                        @endforeach
                          <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                              Read more
                              <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                          </a>
                      </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-toggle="{{ $candidate->name }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                        <button data-modal-toggle="{{ $candidate->name }}" type="button" class="text-gray-500 bg-[#fff9f4] hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                    </div>
                </div>
            </div>
          </div>
          <button type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:opacity-25" {{ (Auth::user()->candidate_id) ? 'disabled' : ''}} data-modal-toggle="vote-confirmation-{{ $candidate->id }}">
            Vote
          </button>
          <div id="vote-confirmation-{{ $candidate->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-md md:h-auto">
                <div class="relative bg-[#fff9f4] rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="vote-confirmation-{{ $candidate->id }}">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to vote {{ $candidate->name }} ?</h3>
                        <button data-modal-toggle="vote-confirmation-{{ $candidate->id }}" type="submit" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <button data-modal-toggle="vote-confirmation-{{ $candidate->id }}" type="button" class="text-gray-500 bg-[#fff9f4] hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                    </div>
                </div>
            </div>
        </div>
        </form>

        @endforeach


        @foreach ($candidates as $candidate)
        <form action="{{ url('voting') }}/{{ $candidate->id }}" method="post">
          @csrf
          @method('DELETE')
          {{-- <button type="button" class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" data-modal-toggle="delete-modal-{{ $candidate->id }}">Delete</button> --}}
          <div id="delete-modal-{{ $candidate->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
              <div class="relative w-full h-full max-w-md md:h-auto">
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                      <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="delete-modal-{{ $candidate->id }}">
                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                          <span class="sr-only">Close modal</span>
                      </button>
                      <div class="p-6 text-center">
                          <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                          <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this Candidate : {{ $candidate->name }}?</h3>
                          <button data-modal-toggle="delete-modal-{{ $candidate->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                              Yes, I'm sure
                          </button>
                          <button data-modal-toggle="delete-modal-{{ $candidate->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                      </div>
                  </div>
              </div>
          </div>
      </form>
        @endforeach

        <!-- More products... -->
      </div>
      @if($user->role == 'admin')
      {{-- Statistics --}}
      <h3 class="text-3xl text-gray-50 font-bold mt-4 hover:text-blue-700 cursor-pointer">Live Statistics</h3>
      <p class="text-gray-50"> Who haven't voted yet : {{ $n_not_voted }} </p>
      @endif

      {{-- Card --}}

    </div>
  </div>

@endsection

@push('scripts')
<script src="{{ asset('js/jquery-3.6.3.slim.min.js') }}"></script>
<script type="text/javascript">
  let all_missions = [];
  $(document).ready(function(){
    $('#add_mission_field').click(function(){
      $('#mission_fields').append(`
      <div class="flex items-center space-x-2"><input type="text" name="mission[]" class="form-input rounded-md shadow-sm mt-1 block w-full" placeholder="Mission" /><button type="button" id="remove_field" class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">Remove</button></div>
      `);
    });

    $('#mission_fields').on('change', function(){
      all_missions = [];
      $('#mission_fields input').each(function(){
        all_missions.push($(this).val());
      });
      $('#all_missions').val(all_missions); // reset all missions
    });

    $('#mission_fields').on('click', '#remove_field', function(e){
      e.preventDefault();
      $(this).parent('div').remove();
    });
  })
</script>
@endpush