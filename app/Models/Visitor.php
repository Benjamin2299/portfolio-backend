<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip',
        'country',
        'city',
        'device',
        'browser',
        'page',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];
}