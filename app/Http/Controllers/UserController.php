<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
//    Show all users
    public function index()
    {
        return view('dashboard', [
            'students' => User::all(),
            'tabChoosen' => 'students'
        ]);
    }

    public function postIndex(Request $request){
        if($request->has('tab-choosen')){
            switch ($request->get('tab-choosen')){
                case 'students':
                    return view('dashboard', [
                        'students' => User::all(),
                        'tabChoosen' => 'students'
                    ]);
                case 'dashboard':
                    return view('dashboard', [
                        'students' => User::all(),
                        'tabChoosen' => 'dashboard'
                    ]);
                case 'setting':
                    return view('dashboard', [
                        'students' => User::all(),
                        'tabChoosen' => 'setting'
                    ]);
                case 'contacts':
                    return view('dashboard', [
                        'students' => User::all(),
                        'tabChoosen' => 'contacts'
                    ]);

            }
        }

    }
}
