<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyParameterOption extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyParameterOptionFactory> */
    use HasFactory;

    protected $fillable = [
        'property_parameter_id',
        'property_attribute_option_id',
    ];

    public function property_parameter()
    {
        return $this->belongsTo(PropertyParameter::class, 'property_parameter_id');
    }

    public function property_attribute_option()
    {
        return $this->belongsTo(PropertyAttributeOption::class, 'property_attribute_option_id');
    }
}
