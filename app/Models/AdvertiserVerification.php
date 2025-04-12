<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertiserVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'verification_annunciant_state',
        'submissionDate',
        'validationDate',
        'document_url',
        'photo_url',
        'validatedBy',
        'submittedBy',
        'submittedAt',
        'validatedAt',
    ];

    protected $casts = [
        'submissionDate' => 'datetime',
        'validationDate' => 'datetime',
        'submittedAt' => 'datetime',
        'validatedAt' => 'datetime',
    ];

    /**
     * Utilizador que submeteu a verificação.
     */
    public function submitter()
    {
        return $this->belongsTo(User::class, 'submittedBy');
    }

    /**
     * Utilizador que validou a verificação.
     */
    public function validator()
    {
        return $this->belongsTo(User::class, 'validatedBy');
    }

    protected static function booted()
    {
        static::created(function ($verification) {
            if (
                $verification->verification_annunciant_state === 1 &&
                $verification->submitter &&
                !$verification->submitter->advertiserNumber
            ) {
                $verification->submitter?->update([
                    'advertiserNumber' => rand(10000, 99999),
                ]);
            }
        });
    }

}
