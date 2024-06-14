<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PointTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'type',
        'duration',
        'is_streaked',
        'streak',
        'max_streak',
        'point_value',
        'is_completed'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function pointsRegisters()
    {
        return $this->hasMany(PointsRegister::class);
    }
}
