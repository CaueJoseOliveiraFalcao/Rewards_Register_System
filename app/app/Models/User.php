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
    public function getPointsRegisters()
    {
        $userId =  Auth::user()->id;
        $userTablePointMain = PointsRegister::where('user_id', $userId)
        ->where('table_name', '!=' , 'MAIN TABLE')
        ->get();
        return $userTablePointMain;
    }
    public function verifyUserTaskStatus()
    {
        $user  = Auth::user();
        $allUserRegisters = $this->getPointsRegisters();
        $today = now()->format('Y-m-d');
        $today = '2024-06-27';
        foreach ($allUserRegisters as $key => $register) {

            if ($today != $register->created_at->format('Y-m-d')){
                $tablePoint = PointTable::where('id', $register->point_table_id)->first();
                if ($tablePoint->is_completed === 1) {
                    $tablePoint->is_completed = 0;
                }
                $tablePoint->save();
            }
        }
        PointsRegister::where('user_id', $user->id);
    }
    public function pointsRegisters() : HasMany
    {
        return $this->hasMany(PointsRegister::class);
    }
}
