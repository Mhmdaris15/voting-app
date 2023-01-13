<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
//    Show all users
    public function index()
    {
//        $user = User::all();
//        $candidate = $user->candidate()->paginate(7);
        $users = User::with('candidate')->get();
        $candidates = Candidate::all();
        return view('dashboard', [
//            'students' => DB::table('users')->paginate(7),
            'students'=> $users,
            'candidates'=> $candidates,
            'tabChoosen' => 'students',
        ]);
    }

    public function postIndex(Request $request){
        if($request->has('tab-choosen')){
            $users = User::with('candidate')->get();
            $candidates = Candidate::with('users')->get();
            switch ($request->get('tab-choosen')){
                case 'students':
                    return view('dashboard', [
//                        'students' => DB::table('users')->paginate(7),
                        'students'=> $users,
                        'candidates'=> $candidates,
                        'tabChoosen' => 'students'
                    ]);
                case 'statistics':
                    return view('dashboard', [
                        'candidates' => $candidates,
                        'candidate_names' => $candidates->pluck('name'),
                        'n_candidate_voters' => $candidates->map(function ($candidate){
                            return $candidate->users->count();
                        }),
                        'tabChoosen' => 'statistics'
                    ]);
                case 'candidates':
                    return view('dashboard', [
                        'tabChoosen' => 'candidates'
                    ]);
                case 'contacts':
                    return view('dashboard', [
                        'tabChoosen' => 'contacts'
                    ]);

            }
        }

    }

    public function update(Request $request, $id){
//       validate data
        $request->validate([
            'nisn'=> 'required|numeric',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required',
            'candidate_id' => 'required|numeric',
        ]);


//        update data
        $user = User::find($id);
        $old_name = $user->name;
        $user->nisn = $request->get('nisn');
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->candidate_id = $request->get('candidate_id');
        $user->save();
        return redirect()->route('dashboard')->with('success', 'Data '.$old_name.' was updated');
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('dashboard')->with('success', 'User deleted successfully');
    }
}
