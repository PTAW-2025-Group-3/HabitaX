<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AdvertiserVerification extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'verification_advertiser_state',
        'submissionDate',
        'validationDate',
        'identifier_type',
        'validated_by',
        'submitted_by',
        'submitted_at',
        'validated_at',
        'validator_comments',
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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('documents')
            ->useDisk('public');
        $this->addMediaCollection('identity_verifications')
            ->useDisk('public');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->fit(Fit::Crop, 800, 600)
            ->optimize()
            ->sharpen(5)
            ->performOnCollections('documents');

        $this->addMediaConversion('preview')
            ->fit(Fit::Crop, 800, 600)
            ->optimize()
            ->sharpen(5)
            ->performOnCollections('identity_verifications');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($verification) {
            $verification->clearMediaCollection('documents');
            $verification->clearMediaCollection('identity_verifications');
        });
    }

    protected static function booted()
    {
        static::updated(function ($verification) {
            if (
                $verification->verification_advertiser_state === 1 &&
                $verification->submitter &&
                !$verification->submitter->is_advertiser
            ) {
                $verification->submitter->update([
                    'is_advertiser' => true,
                ]);
            }
        });
    }
}
