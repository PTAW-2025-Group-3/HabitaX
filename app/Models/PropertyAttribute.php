<?php

namespace App\Models;

use App\Enums\AttributeType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'is_active',
        'is_required',
        'min_value',
        'max_value',
        'unit',
        'min_length',
        'max_length',
        "min_options",
        "max_options",
        'min_date',
        'max_date',
    ];

    protected $casts = [
        'type' => AttributeType::class,
        'is_active' => 'boolean',
        'is_required' => 'boolean',
        'min_value' => 'float',
        'max_value' => 'float',
        'min_length' => 'integer',
        'max_length' => 'integer',
        'min_options' => 'integer',
        'max_options' => 'integer',
        'min_date' => 'date',
        'max_date' => 'date',
    ];

    public function options()
    {
        return $this->hasMany(PropertyAttributeOption::class, 'property_attribute_id');
    }
}
