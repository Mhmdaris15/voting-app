<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::with('users')->get();
        $not_voted = User::where('candidate_id', null)->count();
        // return view('voting', compact('candidates'));
        return view('voting', [
            'user' => auth()->user(),
            'candidates' => $candidates,
            'n_users' => User::count(),
            'n_not_voted' => $not_voted,
        ]);
    }

    public function vote(Request $request, $id)
    {
        // $candidate = Candidate::find($id);
        // $candidate->votes = $candidate->votes + 1;
        // $candidate->save();

        auth()->user()->candidate_id = $id;

        auth()->user()->save();
        Cache::flush();

        // Auto Logout after voted
        auth()->logout();

        return redirect()->route('voting');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:3|unique:candidates|regex:/^[a-zA-Z ]+$/',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $candidate = Candidate::create([
            "name" => $request->name,
            "photo" => $request->file('photo')->store('images', 'public'),
            "vision" => $request->vision,
            "missions" => json_encode($request->missions)
        ]);
        return redirect()->route('voting');
    }
}
