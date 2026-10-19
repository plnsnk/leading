<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'phone', 'social', 'event_type',
        'event_date', 'place', 'format', 'comment',
        'user_id'
    ];
}
