<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'demo_url',
        'github_url',
        'technologies',
        'status',
        'featured',
        'order',
    ];

    protected $casts = [
        'technologies' => 'array',
        'featured' => 'boolean',
    ];
}