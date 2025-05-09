<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAttributeGroupAttribute extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyAttributeGroupAttributeFactory> */
    use HasFactory;

    protected $fillable = [
        'group_id',
        'attribute_id',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function group()
    {
        return $this->belongsTo(PropertyAttributeGroup::class, 'group_id');
    }

    public function attribute()
    {
        return $this->belongsTo(PropertyAttribute::class, 'attribute_id');
    }
}
