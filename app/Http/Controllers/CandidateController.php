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

        return redirect()->route('voting');
    }
}
