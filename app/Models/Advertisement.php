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
        'is_published',
        'is_suspended',
        'property_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'price' => 'float',
        'is_published' => 'boolean',
        'is_suspended' => 'boolean',
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

    // Métodos de conveniência para verificar o estado
    public function isActive()
    {
        return $this->is_published && !$this->is_suspended;
    }

    public function isPending()
    {
        return !$this->is_published && !$this->is_suspended;
    }

    public function isArchived()
    {
        return $this->is_suspended;
    }
}
