<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyParameter extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'attribute_id',
        'value',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function attribute()
    {
        return $this->belongsTo(PropertyAttribute::class, 'attribute_id');
    }
}
