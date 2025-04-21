<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAttributeOption extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyAttributeOptionFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'order',
        'icon_url',
    ];

    protected $casts = [
        'order' => 'integer',
    ];
}
