<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchFilter extends Model
{
    protected $fillable = [
        'name',
        'property_type_id',
        'created_by',
    ];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function parameters()
    {
        return $this->hasMany(PropertyParameter::class);
    }
}
