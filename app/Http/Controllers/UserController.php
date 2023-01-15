<?php

namespace App\Http\Controllers;

use App\Jobs\UserJob;
use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
//    Show all users
    public function index()
    {
//        $user = User::all();
//        $candidate = $user->candidate()->paginate(7);
        $users = User::with('candidate')->paginate();
        // $users = Cache::remember('users', 3600, function () {
        //     return User::with('candidate')->paginate(10);
        // });
        $candidates = Candidate::all();
        return view('dashboard', [
//            'students' => DB::table('users')->paginate(7),
            'students'=> Cache::has('users') ? Cache::get('users') : $users,
            'candidates'=> $candidates,
            'tabChoosen' => 'students',
        ]);
    }

    public function postIndex(Request $request){
        if($request->has('tab-choosen')){
            
            $candidates = Candidate::with('users')->get();
            switch ($request->get('tab-choosen')){
                case 'students':
                    $users = User::with('candidate')->paginate(10);
                    // $users = cache()->remember('users', 3600, function () {
                    //     return User::with('candidate')->paginate(10);
                    // });
                    // Chace for 2 hours
                    return view('dashboard', [
//                       
                        'students'=> Cache::has('users') ? Cache::get('users') : $users,
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
                case 'generate-data':
                    // Job Here
                    // $job = new UserJob();
                    // $this->dispatch($job);
                    Cache::flush();
                    return view('dashboard', [
                        'tabChoosen' => 'generate-data'
                    ]);

            }
        }
    }

    public function generate(Request $request){
        $job = new UserJob();
        $this->dispatch($job);
        $this->dispatch($job);
        return redirect()->route('dashboard')->with('success', 'Data generated successfully');
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
        Cache::flush();

        return redirect()->route('dashboard')->with('success', 'Data '.$old_name.' was updated');
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        Cache::flush();
        return redirect()->route('dashboard')->with('success', 'User deleted successfully');
    }
}
