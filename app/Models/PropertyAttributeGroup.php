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
        'is_active'
    ];

    public function attributes()
    {
        return $this->hasMany(PropertyAttribute::class, 'group_id');
    }
}
