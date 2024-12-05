<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $table = 'community';
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'desc',
        'image',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'phone' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
