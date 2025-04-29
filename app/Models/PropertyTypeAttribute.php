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
        'is_required',
        'is_active',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function property_type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function property_attribute()
    {
        return $this->belongsTo(PropertyAttribute::class, 'attribute_id');
    }
}
