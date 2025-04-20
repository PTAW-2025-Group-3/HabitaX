<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertiserVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'verification_advertiser_state',
        'submissionDate',
        'validationDate',
        'document_url',
        'photo_url',
        'validated_by',
        'submitted_by',
        'submitted_at',
        'validated_at',
    ];

    protected $casts = [
        'submission_date' => 'datetime',
        'validation_date' => 'datetime',
        'submitted_at' => 'datetime',
        'validated_at' => 'datetime',
    ];

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
            if (
                $verification->verification_advertiser_state === 1 &&
                $verification->submitter &&
                !$verification->submitter->advertiser_number
            ) {
                $verification->submitter->update([
                    'advertiser_number' => rand(10000, 99999),
                ]);
            }
        });
    }

}
