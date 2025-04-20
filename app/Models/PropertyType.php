<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;
    /** @use HasFactory<\Database\Factories\PropertyTypeFactory> */
    protected $fillable = [
        'name',
        'description',
        'icon',
        'is_active'
    ];

    public function attributes()
    {
        return $this->belongsToMany(PropertyAttribute::class, 'property_type_attributes', 'property_type_id', 'property_attribute_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'property_type_id');
    }
}
