<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
     use Notifiable;

    protected $table = 'students';
    protected $fillable = [
        'name',
        'age',
    ];
}
