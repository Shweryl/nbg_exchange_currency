<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryRate extends Model
{
    protected $fillable = [
        'from',
        'to',
        'rate',
        'date'
    ];
}
