<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'isActive',
        'minimal_value',
        'maximal_value',
        'min_char',
        'max_char',
        'options',
    ];

    protected $casts = [
        'isActive' => 'boolean',
        'minimal_value' => 'decimal:0',
        'maximal_value' => 'decimal:0',
        'options' => 'array',
    ];
}
