<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointsRegister;
use App\Models\PointTable;
use Auth;
use App\Providers\RouteServiceProvider;
class PointRegister extends Controller
{
    public function show_rescure(){
        return view('rescure');
    }
    public function rescure(Request $request){
        $user = Auth::user();
        $mainTable = $user->getPointTableInfo();
        $rescureTable = $user->getRescureTable();
        if (count($rescureTable) === 0){
            $initialTable = PointTable::create([
                'name' => 'RESCURE_TABLE',
                'user_id' => $user->id,
                'type' => 'SUBTRATION',
                'duration' => 0,
                'is_streaked' => 0,
                'streak' => 0, 
                'max_streak' => 0,
                'point_value' => 0,
                'is_completed' => 1,
            ]);
            $Register = PointsRegister::create([
                'user_id' => $user->id,
                'point_table_type' => $initialTable->type,
                'point_table_value' =>$request->points_value,
                'point_table_id' => $initialTable->id,
                'table_name' =>  $request->task_name
            ]);
        }
        else{
            $table = $rescureTable[0];
            $table->point_value = $request->points_value;
            $Register = PointsRegister::create([
                'user_id' => $user->id,
                'point_table_type' => $table->type,
                'point_table_value' => $table->point_value,
                'point_table_id' => $table->id,
                'table_name' => $request->task_name
            ]);
        }
        dd($rescureTable);

    }
    public function createRegister($id)
    {
        $user = Auth::user();
        $table = PointTable::find($id);
        $userTablePointMain = PointTable::where('user_id', $user->id)
        ->where('name', 'MAIN TABLE')->first();
            $Register = PointsRegister::create([
                'user_id' => $user->id,
                'point_table_type' => $table->type,
                'point_table_value' => $table->point_value,
                'point_table_id' => $table->id,
                'table_name' => $table->name
            ]);
            if ($table->is_streaked){
                $table->streak += 1;
            }
            $userTablePointMain->point_value += $table->point_value;
            $userTablePointMain->save();
            $Register->save();
            $table->save();

            return redirect(RouteServiceProvider::HOME);
    }
    public function status(Request $request){
        return view('estatistics');
    }
    public function return_status(Request $request){

        $user = Auth::user();

        $result = $user->getMonthPoints($request->month , $request->year);
        $giftsMonth = $user->getMonthGifts($request->month , $request->year);
        return view('month-points' , compact('result' , 'giftsMonth'));
    }
}
