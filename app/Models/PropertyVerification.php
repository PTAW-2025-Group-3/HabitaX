<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'state',
        'documentation',
        'submission_date',
        'validation_date',
        'submitted_by',
        'validated_by',
    ];

    protected $casts = [
        'submission_date' => 'datetime',
        'validation_date' => 'datetime',
        'state' => 'string',
    ];

    /**
     * Propriedade associada.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Utilizador que submeteu a verificação.
     */
    public function submitter()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    /**
     * Utilizador que validou a verificação.
     */
    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    protected static function booted()
    {
        static::created(function ($verification) {
            if ($verification->state === 'approved' && $verification->property) {
                $verification->property->update(['is_verified' => true]);
            }
        });
    }

}
