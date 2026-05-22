<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'company',
        'avatar',
        'content',
        'rating',
        'featured',
        'status',
        'order',
    ];

    protected $casts = [
        'rating' => 'integer',
        'featured' => 'boolean',
        'order' => 'integer',
    ];
}