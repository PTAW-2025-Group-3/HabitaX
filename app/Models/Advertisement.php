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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function requests()
    {
        return $this->hasMany(ContactRequest::class, 'advertisement_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
