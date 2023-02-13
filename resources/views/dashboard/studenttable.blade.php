{{-- Show the current URL to Page --}}



<div class="flex gap-x-6 py-2 items-end px-3">
    <div>
        <button id="dropdownKelasButton" data-dropdown-toggle="dropdownKelas" data-dropdown-placement="bottom" class="w-28 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Kelas<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
        <!-- Dropdown Kelas -->
        <div id="dropdownKelas" class="z-10 hidden bg-white rounded shadow w-36 dark:bg-gray-700">
            <ul class="h-60 py-1 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownKelasButton">
                @foreach ($classes as $class)
                <li>
                    {{-- action will be current url + class=$class --}}
                    <form method="GET" action="{{ url('dashboard') }}" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <a href="{{ URL::current() . '?' . http_build_query(array_merge(request()->query(), ['class' => $class])) }}" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $class }}</a>
                        {{-- convert class to url string format --}}
                        <input type="hidden" name="class" value="{{ str_replace(' ', '%20', $class) }}">
                        {{-- <button type="submit">{{ $class }}</button> --}}
                    </form>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div>
        <button id="dropdownStatusVotingButton" data-dropdown-toggle="dropdownStatusVoting" data-dropdown-placement="bottom" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Status Voting<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
        <!-- Dropdown menu -->
        <div id="dropdownStatusVoting" class="z-10 hidden bg-white rounded shadow w-36 dark:bg-gray-700">
            <ul class="h-30 py-1 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownStatusVotingButton">
                <li>
                    <a href="{{ URL::current() . '?' . http_build_query(array_merge(request()->query(), ['votestatus' => '1'])) }}" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Voted
                    </a>
                </li>
                <li>
                    <a href="{{ URL::current() . '?' . http_build_query(array_merge(request()->query(), ['votestatus' => '0'])) }}" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Not Voted
                    </a>
                </li>
            </ul>
        
        </div>
    </div>
    @if (request()->has('filterBy') || request()->has('class'))
        <span class="flex justify-center items-center bg-yellow-100 text-yellow-600 text-sm font-medium mr-2 px-4 py-2.5 rounded dark:bg-yellow-900 dark:text-yellow-300 ">{{ str_replace('%20', ' ', request()->get('class')) }}</span>
    @else 
        <span class="flex justify-center items-center bg-yellow-100 text-yellow-600 text-sm font-medium mr-2 px-4 py-2.5 rounded dark:bg-yellow-900 dark:text-yellow-300 ">All</span>
        @endif
</div>

<div class="px-10 overflow-x-auto relative shadow-md sm:rounded-lg">
    @if(session()->has('success'))
    <div id="toast-danger" class="flex items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div class="ml-3 text-sm font-normal">{{ session()->get('success') }}</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>

    @endif
    

    

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            {{-- <th scope="col" class="p-4">
                <div class="flex items-center">
                    <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-all-search" class="sr-only">checkbox</label>
                </div>
            </th> --}}
            <th scope="col" class="py-3 px-6">
                ID
            </th>
            <th scope="col" class="py-3 px-6">
                Name
            </th>
            <th scope="col" class="py-3 px-6">
                Email
            </th>
            <th scope="col" class="py-3 px-6">
                NISN
            </th>
            <th scope="col" class="py-3 px-6">
                Role
            </th>
            <th scope="col" class="py-3 px-6">
                Kelas
            </th>
            <th scope="col" class="py-3 px-6">
                Selected Candidate
            </th>
            <th scope="col" class="py-3 px-6">
                Actions
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)

        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            {{-- <td class="p-4 w-4">
                <div class="flex items-center">
                    <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                </div>
            </td> --}}
            {{-- get page params from pagination --}}
            @php
                $page = request()->query('page');
                $page = $page ? $page : 1;
            @endphp
            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ ($page - 1) * 15 + $loop->iteration }}
            </th>
            <td class="py-4 px-6">
                {{ $student->name }}
            </td>
            <td class="py-4 px-6">
                {{ $student->email }}
            </td>
            <td class="py-4 px-6">
                {{ $student->nisn }}
            </td>
            <td class="py-4 px-6">
                {{ $student->role }}
            </td>
            <td class="py-4 px-6">
                {{ $student->class }}
            </td>
            <td class="py-4 px-6 {{ empty($student->candidate_id)? 'text-red-600' : 'text-green-700' }}">
                {{ $student->candidate->name ?? 'Not Selected' }}
                {{-- {{ empty($student->candidate_id)? 'Not Selected' : 'Selected' }} --}}
            </td>
            <td class="py-4 px-6 flex">
                {{-- <form action="{{ url('dashboard') }}/{{ $student->id }}" method="post"> --}}
                    {{-- @csrf --}}
                    {{-- @method('UPDATE') --}}
                    <button type="button" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" data-modal-toggle="edit-modal-{{ $student->id }}">Edit</button>
                {{-- </form> --}}
                @include('dashboard.editModal', ['student' => $student])
                <form action="{{ url('dashboard') }}/{{ $student->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" data-modal-toggle="delete-modal-{{ $student->id }}">Delete</button>
                    <div id="delete-modal-{{ $student->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                        <div class="relative w-full h-full max-w-md md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="delete-modal-{{ $student->id }}">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-6 text-center">
                                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                                    <button data-modal-toggle="delete-modal-{{ $student->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Yes, I'm sure
                                    </button>
                                    <button data-modal-toggle="delete-modal-{{ $student->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{-- Check if there is a request named filterBy or class--}}
    @if (request()->has('votestatus') || request()->has('class'))
        {{-- {{ $students->appends(['filterBy' => request()->filterBy, 'class' => request()->class])->links() }} --}}
        {{ $students->withQueryString()->links() }}
    @else
   {{ $students->links() }}
    @endif
</div>

@push('scripts')
    <script>
        // filter by class
    </script>
@endpush