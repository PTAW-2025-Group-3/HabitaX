<?php

namespace App\Models;

use App\Enums\UserStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'document_type_id',
        'document_number',
        'nif',
        'email_notifications',
        'message_notifications',
        'public_profile',
        'show_email',
        'telephone',
        'user_type',
        'is_advertiser',
        'staff_number',
        'state',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'email_notifications' => 'boolean',
        'message_notifications' => 'boolean',
        'public_profile' => 'boolean',
        'show_email' => 'boolean',
        'nif' => 'integer',
        'telephone' => 'integer',
        'is_advertiser' => 'boolean',
        'staff_number' => 'integer',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('picture')->useDisk('public');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->format('webp')
            ->optimize()
            ->fit(Fit::Crop, 100, 100)
            ->performOnCollections('picture');
    }

    public function getProfilePictureUrl()
    {
        if ($this->hasMedia('picture')) {
            return $this->getFirstMediaUrl('picture', 'thumb');
        }
        return asset('images/default-pfp-habitax.png');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'created_by');
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'created_by');
    }

    public function favoriteAdvertisements()
    {
        return $this->hasMany(FavoriteAdvertisement::class);
    }

    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    public function isModerator()
    {
        return $this->user_type === 'moderator' || $this->user_type === 'admin';
    }

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }

    public function advertiserVerifications()
    {
        return $this->hasMany(AdvertiserVerification::class, 'submitted_by');
    }

}
