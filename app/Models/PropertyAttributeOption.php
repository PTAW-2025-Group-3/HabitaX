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

    public function property_attributes()
    {
        return $this->belongsToMany(PropertyAttribute::class, 'property_attribute_option_property_attribute', 'property_attribute_option_id', 'property_attribute_id');
    }
}
