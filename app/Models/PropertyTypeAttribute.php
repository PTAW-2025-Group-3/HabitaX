<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyTypeAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_type_id',
        'attribute_id',
        'show_in_list',
        'show_in_filter',
    ];

    protected $casts = [
        'show_in_list' => 'boolean',
        'show_in_filter' => 'boolean',
    ];

    public function property_type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function attribute()
    {
        return $this->belongsTo(PropertyAttribute::class, 'attribute_id');
    }
}
