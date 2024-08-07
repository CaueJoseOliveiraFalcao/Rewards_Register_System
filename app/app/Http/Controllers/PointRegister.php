<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointsRegister;
use App\Models\PointTable;
use Auth;
use App\Providers\RouteServiceProvider;
class PointRegister extends Controller
{
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
        return view('month-points' , compact('result'));
    }
}
