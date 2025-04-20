<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'reference',
        'title',
        'description',
        'transaction_type',
        'price',
        'state',
        'property_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
