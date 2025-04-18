<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    protected $fillable = ['name', 'description'];
    /** @use HasFactory<\Database\Factories\PropertyTypeFactory> */
    use HasFactory;

    public function attributes()
    {
        return $this->hasMany(PropertyAttribute::class, 'property_type_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'property_type');
    }
}
