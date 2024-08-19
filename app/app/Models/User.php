<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Controllers\PointRegister;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\PointsRegister;
use App\Models\PointTable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Auth;
use PHPUnit\Framework\Constraint\IsEmpty;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'points',
        'today_points'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Get the user that owns the User
     *
     * @return 
     */
    public function point(): HasMany
    {
        return $this->hasMany(PointTable::class);
    }
    public function getValidTables()
    {
        $userId =  Auth::user()->id;
        $userTablePointMain = PointTable::where('user_id', $userId)
        ->where('name', '!=' , 'MAIN TABLE')
        ->get();
        return $userTablePointMain;
    }
    public function getPointTableInfo()
    {
        $userId =  Auth::user()->id;
        $userTablePointMain = PointTable::where('user_id', $userId)
        ->where('name', 'MAIN TABLE')->first();
        return $userTablePointMain;
    }
    public function getRescureTable(){
        $userId =  Auth::user()->id;
        $userTablePointMain = PointTable::where('user_id', $userId)
        ->where('name', '!=' , 'MAIN TABLE')
        ->where('type', 'SUBTRATION')
        ->get();
        return $userTablePointMain;
    }
    public function getPointsRegisters()
    {
        $userId =  Auth::user()->id;
        $userTablePointMain = PointsRegister::where('user_id', $userId)
        ->where('table_name', '!=' , 'MAIN TABLE')
        ->where('point_table_type', '!=' , 'SUBTRATION')
        ->get();
        return $userTablePointMain;
    }
    public function getExtraPoints()
    {
        $userId =  Auth::user()->id;
        $userTablePointMain = ExtraPoints::where('user_id', $userId)
        ->get();
        return $userTablePointMain;
    }
    public function verifyUserTaskStatus()
    {
        $user  = Auth::user();
        $allUserRegisters = $this->getPointsRegisters();
        $allUserTables = $this->getValidTables();
        //verifica se a tabela do usurio tem algum registro no banco de dados
        foreach ($allUserTables as $key => $table) {
            $foundRegister = false;
            if ($allUserRegisters->isEmpty()){
                $foundRegister = false;
            }
            else{
                foreach ($allUserRegisters as $key => $register) {
                    if ($register->point_table_id === $table->id) {
                        $foundRegister = true;
                        break;
                    }
    
                }
            }

            if ($foundRegister === false) {
                $table->is_completed = 0;
            }
            $table->save();
    }
        //verifica se os registros que estao no banco de dados do usuario estão no dia de hoje
        $today = now()->format('Y-m-d');
        foreach ($allUserRegisters as $key => $register) {

            if ($today != $register->created_at->format('Y-m-d')){

                $tablePoint = PointTable::where('id', $register->point_table_id)->first();
                if ($tablePoint->is_completed === 1) {
                    $tablePoint->is_completed = 0;
                }
                $tablePoint->save();
            }
            if($today === $register->created_at->format('Y-m-d')){

                $tablePoint = PointTable::where('id', $register->point_table_id)->first();

                if ($tablePoint->is_completed === 0) {
                    $tablePoint->is_completed = 1;
                }
                $tablePoint->save();
            }
        }
        PointsRegister::where('user_id', $user->id);
    }
    public function getTodayPoints()
    {
        $user = Auth::user();
        $allUserRegisters = $this->getPointsRegisters();
        $allUserExtraPoints = $this->getExtraPoints();
        $today = now()->format('Y-m-d');
        $todayPoints = 0;
        if (!$allUserRegisters->isEmpty()) {
            foreach ($allUserRegisters as $key => $register) {
                if($register->created_at->format('Y-m-d') == $today){
                    $todayPoints += $register->point_table_value;
                }
            }
        }
        if (!$allUserExtraPoints->isEmpty()) {
            foreach ($allUserExtraPoints as $key => $register) {
                if($register->created_at->format('Y-m-d') == $today){
                    $todayPoints += $register->point_value;
                }
            }
        }
        return $todayPoints;

    }
    public function getMonthPoints($mounth , $year)
    {
        $user = Auth::user();
        $allUserRegisters = $this->getPointsRegisters();
        $allUserExtraPoints = $this->getExtraPoints();

        $allUserRegistersThisMonth = [];
        $allUserExtraPointsThisMonth = [];

        foreach ($allUserRegisters as $key => $register) {

            $registerYear = $register->created_at->format('Y');
            $registerMonth = $register->created_at->format('m');
            if($year == $registerYear && $registerMonth == $mounth){
                $allUserRegistersThisMonth[] = $register;
            }
        }
        
        foreach ($allUserExtraPoints as $key => $register) {

            $registerYear = $register->created_at->format('Y');
            $registerMonth = $register->created_at->format('m');
            if($year == $registerYear && $registerMonth == $mounth){
                $allUserExtraPointsThisMonth[] = $register;
            }
        }
        return [
            'registers' => $allUserRegistersThisMonth,
            'extraPoints' => $allUserExtraPointsThisMonth,
        ];

    }
    public function pointsRegisters() : HasMany
    {
        return $this->hasMany(PointsRegister::class);
    }
    public function extraPoints() : HasMany
    {
        return $this->hasMany(ExtraPoints::class);
    }
}
