<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAttributeGroup extends Model
{
    use HasFactory;
    /** @use HasFactory<\Database\Factories\PropertyAttributeGroupFactory> */
    protected $fillable = [
        'name',
        'description',
        'icon_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function attributes()
    {
        return $this->belongsToMany(PropertyAttribute::class, 'property_attribute_group_attributes', 'group_id', 'attribute_id')
            ->withPivot('order')
            ->orderBy('order');
    }
}
