<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyParameterOption extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyParameterOptionFactory> */
    use HasFactory;

    protected $fillable = [
        'parameter_id',
        'option_id',
    ];

    public function parameter()
    {
        return $this->belongsTo(PropertyParameter::class, 'parameter_id');
    }

    public function option()
    {
        return $this->belongsTo(PropertyAttributeOption::class, 'option_id');
    }
}
