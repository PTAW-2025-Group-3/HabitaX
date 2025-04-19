<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;
    /** @use HasFactory<\Database\Factories\PropertyTypeFactory> */
    protected $fillable = ['name', 'description', 'icon', 'is_active'];

    public function attributes()
    {
        return $this->hasManyThrough(
            PropertyAttribute::class,
            PropertyTypeAttribute::class,
            'property_type',
            'id',
            'id',
            'attribute_id'
        );
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'property_type');
    }
}
