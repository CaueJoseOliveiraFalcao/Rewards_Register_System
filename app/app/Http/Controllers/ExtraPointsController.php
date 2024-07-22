<?php

namespace App\Http\Controllers;
use App\Models\PointTable;
use Auth;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\ExtraPoints;
class ExtraPointsController extends Controller
{
    public function show(){
        return view("extra_points");
    }

    public function store(Request $request){
        $user = Auth::user();

        $extra = ExtraPoints::create([
            'user_id'=> $user->id,
            'table_name'=> $request->task_name,
            'type' => $request->task_type,
            'point_value' => $request->points_value,
        ]);

        $userTablePointMain = PointTable::where('user_id', $user->id)
        ->where('name', 'MAIN TABLE')->first();
        $userTablePointMain->point_value += $request->points_value;
        $userTablePointMain->save();    
        $extra->save();
        return redirect(RouteServiceProvider::HOME);
    }
}
