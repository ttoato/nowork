<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Process;

class ProcessController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index($vacancy)
    {
        $authuser = auth()->user();

        if($authuser->role_id == 4){

            $processes = $authuser->candidate->load('processes')->processes;
            return view('process.index', compact('processes'));

        }elseif($authuser->role_id == 3){

            // $processes = $authuser->recruiter->company->vacancy->processes;
            $processes = Process::where('id_vacancy', $vacancy)->get();

            return view('process.index', compact('processes'));

        }else{
            return redirect()->route('profile.show' ,['username' => auth()->user()->user_name]);
        }

    }

    public function create(){
        $authuser = auth()->user();

        if($authuser->role_id == 3){

            $processes = $authuser->recruiter->company->vacancy->processes;
            return view('process.create');
        }else{
            return redirect()->route('profile.show' ,['username' => auth()->user()->user_name]);
        }
    }

    public function store(Request $request){
        $authuser = auth()->user();

        if ($authuser->role_id == 3) {

            $id = $request->input('id_vacancy');

            $points1 = request()->input('points1');
            $points2 = request()->input('points2');
            $points3 = request()->input('points3');

            $totalPoints = $points1 + $points2 + $points3;

            $process = Process::create([
                'id_vacancy' => $id,
                'id_candidate' => $authuser->candidate->id,
                'points' => $totalPoints,
            ]);

            return redirect()->route('process.index');
        } else {
            return redirect()->route('profile.show' ,['username' => auth()->user()->user_name]);
        }
    }


    public function edit(){
    }

    public function update(){

    }


}
