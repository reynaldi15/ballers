<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestHistory extends Model
{
    protected $table='request_history';
    protected $fillable=[
        'user_id',
        'payment_id',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
