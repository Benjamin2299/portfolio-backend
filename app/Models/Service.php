<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'color',
        'price',
        'status',
        'featured',
        'order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'featured' => 'boolean',
        'order' => 'integer',
    ];
}