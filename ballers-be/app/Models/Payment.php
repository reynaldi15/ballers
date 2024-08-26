<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $fillable = [
        'basketball_field_id',
        'image'
    ];

    public function venue()
    {
        return $this->belongsTo(BasketballField::class, 'basketball_field_id');
    }
    public function historyOrder()
    {
        return $this->hasOne(RequestHistory::class);
    }
}
