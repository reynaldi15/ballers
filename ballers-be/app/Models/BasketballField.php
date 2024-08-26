<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketballField extends Model
{
    protected $table = 'basketball_field';
    protected $fillable = [
        'user_id',
        'title',
        'image',
        'price',
        'address',
        'desc',
        'date',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'price' => 'integer',
        'date' => 'date',
    ];

    public function requestField()
    {
        return $this->hasOne(RequestField::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
