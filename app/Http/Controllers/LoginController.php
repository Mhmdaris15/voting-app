<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

      /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        // The first way
        // $credentials = $request->only('email', 'password');

        // if (Auth::attempt($credentials)) {

        //     // Save the user's NISN to the session
        //     $request->session()->put('NISN', $request->NISN);

        //     // Authentication passed...
        //     return redirect()->intended('voting');
        // } else {
        //     return dd('gagal');
        // }

        // The second way
        $credentials = $request->only('email', 'password');
        if(!Auth::validate($credentials)) {
            return redirect()->back()->withErrors(trans('auth.failed'));
        }
    
    
        $user = Auth::getProvider()->retrieveByCredentials($credentials); // Get the user

        Auth::login($user); // Log the user in
        $request->session()->put('NISN', $request->NISN);

        return redirect()->intended('voting');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'You have been logged out');
    }

}
