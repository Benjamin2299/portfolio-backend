<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'level',
        'icon',
        'order',
    ];

    protected $casts = [
        'level' => 'integer',
        'order' => 'integer',
    ];
}