<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Textinfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'content',
        'link',
        'image',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
