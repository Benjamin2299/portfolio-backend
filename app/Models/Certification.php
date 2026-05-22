<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'issuer',
        'credential_id',
        'credential_url',
        'image',
        'issued_at',
        'expires_at',
        'featured',
        'order',
    ];

    protected $casts = [
        'issued_at' => 'date',
        'expires_at' => 'date',
        'featured' => 'boolean',
        'order' => 'integer',
    ];
}