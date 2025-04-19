<?php

namespace App\Models;

use App\AttributeType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'is_active',
        'is_required',
        'minimal',
        'maximal',
        'unit',
    ];

    protected $casts = [
        'type' => AttributeType::class,
        'is_active' => 'boolean',
        'is_required' => 'boolean',
        'minimal' => 'decimal:0',
        'maximal' => 'decimal:0',
    ];
}
