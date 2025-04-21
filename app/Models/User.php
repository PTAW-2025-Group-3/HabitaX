<?php

namespace App\Models;

use App\Enums\UserStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'email_notifications',
        'message_notifications',
        'public_profile',
        'show_email',
        'telephone',
        'profile_photo_url',
        'user_type',
        'advertiser_number',
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
        'telephone' => 'integer',
        'advertiser_number' => 'integer',
        'staff_number' => 'integer',
    ];

    public function properties()
    {
        return $this->hasMany(Property::class, 'created_by');
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'created_by');
    }

    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    public function isModerator()
    {
        return $this->user_type === 'moderator' || $this->user_type === 'admin';
    }
}
