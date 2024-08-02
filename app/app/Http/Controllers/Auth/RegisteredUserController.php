<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PointsRegister;
use App\Models\PointTable;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'points' => ['required','integer'],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'points' => $request->points,
            'today_points' => 0
        ]);
        
        $userid = User::where('email' , $request->email)->first();
        $tableMainP = PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'MAIN TABLE',
            'type'=> 'MAIN TABLE',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> $request->points,
            'is_completed' => 1
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Check-in Diario/celular',
            'type'=> 'BING_VARIAVEL',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 5,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Conjunto Diario',
            'type'=> 'BING',
            'duration'=> 99999,
            'is_streaked' => 1,
            'streak' => 1,
            'max_streak' => 0,
            'point_value'=> 30,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Bonus de Sequencia',
            'type'=> 'BING_VARIAVEL',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 50,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Pesquisas Móvel',
            'type'=> 'BING',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 60,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Pesquisas PC',
            'type'=> 'BING',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 90,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Ler e Ganhar',
            'type'=> 'BING',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 30,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Atividades',
            'type'=> 'BING_VARIAVEL',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 25,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Jogar um Jogo no PC',
            'type'=> 'XBOX',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 20,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Jogar Jewel',
            'type'=> 'XBOX',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 5,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Usar o App Xbox',
            'type'=> 'XBOX_VARIAVEL',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 5,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Jogar um Jogo no Console',
            'type'=> 'XBOX',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 10,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Bonus Semanal de Console',
            'type'=> 'XBOX_VARIAVEL',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 250,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Jogar um Jogo Com GamePass',
            'type'=> 'XBOX',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 3,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Ganhar uma Conquista',
            'type'=> 'XBOX',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 5,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Game Pass Ultimate Bonus 25',
            'type'=> 'XBOX',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 25,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Game Pass Ultimate Bonus 100',
            'type'=> 'XBOX',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 100,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Game Pass Ultimate Bonus 500',
            'type'=> 'XBOX',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 500,
            'is_completed' => 0
        ]);
        PointTable::create([
            'user_id'=> $userid->id,
            'name'=> 'Game Pass Ultimate Bonus 1000',
            'type'=> 'XBOX',
            'duration'=> 99999,
            'is_streaked' => 0,
            'streak' => 0,
            'max_streak' => 0,
            'point_value'=> 1000,
            'is_completed' => 0
        ]);
        $pointTable = PointTable::where('user_id', $userid->id)
        ->where('name', $tableMainP->name)
        ->first();
        PointsRegister::create([
            'user_id'=> $userid->id,
            'table_name' > $pointTable->name,
            'point_table_type' => $pointTable->type,
            'point_table_value' => $pointTable->point_value,
            'point_table_id' => $pointTable->id
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
