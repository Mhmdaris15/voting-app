@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="flex gap-5">
        @include('partials.sidebar')

    {{-- Tabs --}}
        <div class="flex-1 inline-block border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                <form action="{{ url('dashboard') }}" method="post">
                    @csrf
                    <li class="mr-2">
                        <input type="hidden" name="tab-choosen" value="students">
                        <button href="#" class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent {{ ($tabChoosen == 'students')? 'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }} group">
                            <svg aria-hidden="true" class="mr-2 w-5 h-5 {{ ($tabChoosen == 'students')? 'text-blue-600 dark:text-blue-500' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>Students
                        </button>
                    </li>
                </form>
                <form action="{{ url('dashboard') }}" method="post">
                    @csrf
                    <li class="mr-2">
                        <input type="hidden" name="tab-choosen" value="statistics">
                        <button href="#" class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent {{ ($tabChoosen == 'statistics')? 'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }} group">
                            <svg aria-hidden="true" class="mr-2 w-5 h-5 {{ ($tabChoosen == 'statistics')? 'text-blue-600 dark:text-blue-500' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" clip-rule="evenodd"></path></svg>Statistics
                        </button>
                    </li>
                </form>
                <form action="{{ url('dashboard') }}" method="post">
                    @csrf
                    <li class="mr-2">
                        <input type="hidden" name="tab-choosen" value="candidates">
                        <button href="#" class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent {{ ($tabChoosen == 'candidates')? 'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }} group">
                            <svg aria-hidden="true" class="mr-2 w-5 h-5 {{ ($tabChoosen == 'candidates')? 'text-blue-600 dark:text-blue-500' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" clip-rule="evenodd"></path></svg>Candidates
                        </button>
                    </li>
                </form>
                <form action="{{ url('dashboard') }}" method="post">
                    @csrf
                    <li class="mr-2">
                        <input type="hidden" name="tab-choosen" value="contacts">
                        <button href="#" class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent {{ ($tabChoosen == 'contacts')? 'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }} group">
                            <svg aria-hidden="true" class="mr-2 w-5 h-5 {{ ($tabChoosen == 'contacts')? 'text-blue-600 dark:text-blue-500' : 'text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>Contacts
                        </button>
                    </li>
                </form>
                <li>
                    <a class="inline-block p-4 text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500">Disabled</a>
                </li>
            </ul>
            @if($tabChoosen == 'students')
                @include('dashboard.studenttable', ['students' => $students])
            @endif
            @if($tabChoosen == 'statistics')
                @include('dashboard.statistics', [
                    'candidates' => $candidates,
                    'candidate_names' => $candidate_names,
                    'n_candidate_voters' => $n_candidate_voters,
                    ])
            @endif
        </div>
    </div>


@endsection
