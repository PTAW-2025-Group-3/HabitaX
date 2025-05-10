<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalVariable extends Model
{
    protected $fillable = [
        'value',
        'updated_by_id',
    ];

    protected $casts = [
        'value' => 'integer',
    ];

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }
}
