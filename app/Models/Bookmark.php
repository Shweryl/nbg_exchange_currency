<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
        'from',
        'to',
        'amount',
        'rate',
        'result',
        'user_id'
    ];
}
