<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'gift_name',
        'gift_value',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
