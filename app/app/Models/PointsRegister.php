<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointsRegister extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'point_table_type',
        'point_table_value',
        'point_table_id',
        'table_name'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pointTable()
    {
        return $this->belongsTo(PointTable::class);
    }
}
