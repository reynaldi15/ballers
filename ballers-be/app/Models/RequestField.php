<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestField extends Model
{
    protected $table = 'request_fields';
    protected $fillable = [
        'user_id',
        'basketball_field_id',
        'date'
    ];
}
