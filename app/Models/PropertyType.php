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
        'icon_path',
        'is_active',
        'show_on_homepage',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_on_homepage' => 'boolean',
    ];

    public function typeAttributes()
    {
        return $this->hasMany(PropertyTypeAttribute::class);
    }

    public function filterAttributes()
    {
        return $this->attributes()
            ->wherePivot('show_in_filter', true);
    }

    public function listAttributes()
    {
        return $this->attributes()
            ->wherePivot('show_in_list', true);
    }

    public function attributes()
    {
        return $this->belongsToMany(PropertyAttribute::class, 'property_type_attributes', 'property_type_id', 'attribute_id')
            ->withPivot('show_in_list', 'show_in_filter')
            ->withTimestamps();
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'property_type_id');
    }
}
