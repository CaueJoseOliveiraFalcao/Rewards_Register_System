<?php

namespace App\Http\Controllers;

use App\Models\PointsRegister;
use App\Models\PointTable;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Auth;
class PointTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function table($id) {
        $user = Auth::user();

        $points = PointTable::find($id);  

        if ($points->user_id == $user->id) {
            return view("edit-task" , compact('points'));
        }
        else{
            return redirect("dashboard");
        }
    }
    public function create(Request $request)
    {
        request()->validate([
            'task_name' => ['required' , 'string'],
            'table_type' => ['required','string'],
            'points_value' => ['required','integer'] 
        ]);
        $userid = Auth::user()->id;

        if ($request->daily_accumulation == "on") {
            $isStreak = 1;
        } else{
            $isStreak = 0;
            $request->current_sequence = 0;
        }
        $initialTable = PointTable::create([
            'name' => $request->task_name,
            'user_id' => $userid,
            'type' => $request->table_type,
            'duration' => 0,
            'is_streaked' => $isStreak,
            'streak' => $request->current_sequence, 
            'max_streak' => 0,
            'point_value' => $request->points_value,
            'is_completed' => 0,
        ]);
        $initialTable->save();
        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PointTable $pointTable)
    {
        return view("pointTableCreator");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PointTable $pointTable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PointTable $pointTable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PointTable $pointTable)
    {
        //
    }
}
