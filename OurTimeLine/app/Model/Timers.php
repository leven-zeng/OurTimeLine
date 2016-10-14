<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Timers extends Model
{
    //
    protected $fillable = [
        'year', 'date', 'address','title', 'content', 'authorId',
    ];
}
