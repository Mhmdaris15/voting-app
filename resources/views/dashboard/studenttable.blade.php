{{-- Show the current URL to Page --}}


<div class="flex flex-col ml-3">
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


        <!-- Modal toggle -->
        <button data-modal-target="add-voter-modal" data-modal-toggle="add-voter-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            Add Voter
        </button>


        <!-- Main modal -->
        <div id="add-voter-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-md md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-[#fff9f4] rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="add-voter-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h3>
                        <form class="space-y-6" action="{{ url('dashboard') }}" method="POST">
                        @csrf
                        <input type="hidden" name="add-voter" value="1">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Voter's Name</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Reiner Bäumler" required>
                            </div>
                            <div>
                                <label for="NISN" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Voter's NISN</label>
                                <input type="text" name="NISN" id="NISN" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="1234567890" required>
                            </div>
                            <div>
                                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option value="admin">Admin</option>
                                    <option value="user">Voter</option>
                                </select>
                            </div>
                            <div>
                                <label for="class" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class</label>
                                <select name="class" id="class" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    {{-- All Class --}}
                                </select>
                            </div>
                            <div>
                                <input type="hidden" name="password" id="password" value="">
                                <input type="hidden" name="email" id="email" value="">
                                <label for="generate-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Generate Random Password</label>
                                <button id="generate-password" type="button" class="text-sm text-gray-700 font-thin border-gray-600 py-3 px-5 bg-gray-300 rounded-xl hover:bg-gray-400">Generate</button>
                                <div class="text-center bg-gray-50 border border-gray-500 w-full py-2 cursor-pointer px-5 my-2 rounded-lg hover:bg-gray-400 focus:ring-blue-500 focus:border-blue-500" id="password-generated"></div>
                                <div id="status" class="text-xs font-thin text-red-400"></div>
                            </div>


                            
                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add New Candidate</button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div> 









    </div>

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
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
        

        

        <table class="w-full bg-transparent text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-100 uppercase bg-gray-600 bg-opacity-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="">
                {{-- <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th> --}}
                <th scope="col" class="py-3 pl-4 rounded-tl-xl">
                    ID
                </th>
                <th scope="col" class="py-3 pl-4">
                    Name
                </th>
                <th scope="col" class="py-3 pl-4">
                    Email
                </th>
                <th scope="col" class="py-3 pl-4">
                    NISN
                </th>
                <th scope="col" class="py-3 pl-4">
                    Role
                </th>
                <th scope="col" class="py-3 pl-4">
                    Kelas
                </th>
                <th scope="col" class="py-3 pl-4">
                    Selected Candidate
                </th>
                <th scope="col" class="py-3 pl-4 rounded-tr-xl">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)

            <tr class="bg-white bg-opacity-50 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
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
                <th scope="row" class="py-4 pl-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ ($page - 1) * 15 + $loop->iteration }}
                </th>
                <td class="py-4 pl-4">
                    {{ $student->name }}
                </td>
                <td class="py-4 pl-4 overflow-clip">
                    {{ $student->email }}
                </td>
                <td class="py-4 pl-4">
                    {{ $student->nisn }}
                </td>
                <td class="py-4 pl-4">
                    {{ $student->role }}
                </td>
                <td class="py-4 pl-4">
                    {{ $student->class }}
                </td>
                <td class="py-4 pl-4 {{ empty($student->candidate_id)? 'text-red-600' : 'text-green-700' }}">
                    {{-- {{ $student->candidate->name ?? 'Not Selected' }} --}}
                    {{ empty($student->candidate_id)? 'Not Selected' : 'Selected' }}
                </td>
                <td class="py-4 pl-4 flex">
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
       <span class="m-2">
            @if (request()->has('votestatus') || request()->has('class'))
            {{-- {{ $students->appends(['filterBy' => request()->filterBy, 'class' => request()->class])->links() }} --}}
            {{ $students->withQueryString()->links() }}
            @else
            {{ $students->links() }}
            @endif
        </span>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        let allClasses = 'X TKP 1,X TKP 2,X DPIB 1,X DPIB 2,X TOI 1,X TOI 2,X TP 1,X TP 2,X TFLM,X TKR 1,X TKR 2,X TKR 3,X TKJ 1,X TKJ 2,X SIJA 1,X SIJA 2,X RPL 1,X RPL 2,X DKV 1,X DKV 2,X DKV 3,XI BKP 1,XI BKP 2,XI DPIB 1,XI DPIB 2,XI TOI 1,XI TOI 2,XI TP 1,XI TP 2,XI TFLM,XI TKR 1,XI TKR 2,XI TKR 3,XI TKJ 1,XI TKJ 2,XI SIJA,XI RPL 1,XI RPL 2,XI MM 1,XI MM 2,XI MM 3,XII BKP 1,XII BKP 2,XII DPIB 1,XII DPIB 2,XII TOI 1,XII TOI 2,XII TP,XII TFLM 1,XII TFLM 2,XII TKR 1,XII TKR 2,XII TKR 3,XII TKJ,XII SIJA 1,XII SIJA 2,XII RPL 1,XII RPL 2,XII MM 1,XII MM 2,XII MM 3,XIII TOI 1,XIII TOI 2,XIII TFLM,XIII SIJA,GURU PNS,TU PNS,GURU PPPK,GURU TU HONOR' 
        let allClassesArray = allClasses.split(',')
        const classElement = document.getElementById('class')
        const generatePasswordBtn = document.getElementById('generate-password')
        let passwordGenerated = document.getElementById('password-generated')
        let name = document.getElementById('name')
        let nisn = document.getElementById('NISN')
        let email = document.getElementById('email')
        
        // change email every name or nisn changed
        name.addEventListener('change', function () {
            let nameValue = name.value
            let nisnValue = nisn.value
            let emailValue = nameValue.split(' ')[0] + nisnValue + '@gmail.com'
            email.value = emailValue

            console.log(email.value)
        })
        nisn.addEventListener('change', function () {
            let nameValue = name.value
            let nisnValue = nisn.value
            let emailValue = nameValue.split(' ')[0] + nisnValue + '@gmail.com'
            email.value = emailValue
            console.log(email.value)
        
        })

        // add option of each class to the select
        allClassesArray.forEach(function (item) {
            let option = document.createElement('option')
            option.value = item
            option.text = item
            classElement.add(option)
        })
        // generate password
        generatePasswordBtn.addEventListener('click', function () {
            let password = Math.random().toString(36).slice(-8)
            document.getElementById('password').value = password
            document.getElementById('password-generated').innerHTML = password
        })
        // copy password
        passwordGenerated.addEventListener('click', function () {
            let password = document.getElementById('password-generated').innerHTML
            let status = document.getElementById('status')
            navigator.clipboard.writeText(password)
            status.innerHTML = '*Password copied to clipboard'
        })
    </script>
@endpush