<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Enums\Unit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Property extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'country',
        'total_area',
        'is_active',
        'is_verified',
        'property_type_id',
        'parish_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_verified' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->useDisk('public');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->format('webp')
            ->optimize()
            ->fit(Fit::Crop, 300, 200)
            ->performOnCollections('images');

        $this->addMediaConversion('preview')
            ->format('webp')
            ->optimize()
            ->fit(Fit::Crop, 800, 600)
            ->performOnCollections('images');

        $this->addMediaConversion('watermark')
            ->format('webp')
            ->optimize()
            ->watermark(
                public_path('images/logos/habitaxLogo.png'),
                paddingX: 2, paddingY: 2, paddingUnit: Unit::Percent,
                width: 20, widthUnit: Unit::Percent,
                height: 10, heightUnit: Unit::Percent,
                alpha: 50
            )
            ->performOnCollections('images');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($property) {
            $property->clearMediaCollection('images');
        });
    }

    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function property_type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function parameters()
    {
        return $this->hasMany(PropertyParameter::class);
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function price_history()
    {
        return $this->hasMany(PriceHistory::class);
    }

    public function verifications()
    {
        return $this->hasMany(PropertyVerification::class);
    }

}
