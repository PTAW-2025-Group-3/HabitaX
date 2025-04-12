<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAttributeType extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_type',
        'attribute_id',
        'required',
    ];

    protected $casts = [
        'required' => 'boolean',
    ];

    public function typeProperty()
    {
        return $this->belongsTo(TypeProperty::class, 'property_type');
    }

    public function attribute()
    {
        return $this->belongsTo(PropertyAttribute::class, 'attribute_id');
    }
}
