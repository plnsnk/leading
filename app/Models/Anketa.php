<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anketa extends Model
{
    protected $fillable = ['user_id', 'application_id', 'answers'];

    protected $casts = ['answers' => 'array'];
}
