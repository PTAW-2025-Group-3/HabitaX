<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PropertyType extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    /** @use HasFactory<\Database\Factories\PropertyTypeFactory> */
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'show_on_homepage',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_on_homepage' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->format('webp')
            ->optimize()
            ->fit(Fit::Crop, 300, 200)
            ->performOnCollections('images');
    }

    public function typeAttributes()
    {
        return $this->hasMany(PropertyTypeAttribute::class);
    }

    public function filterAttributes()
    {
        return $this->attributes()
            ->wherePivot('show_in_filter', true);
    }

    public function listAttributes()
    {
        return $this->attributes()
            ->wherePivot('show_in_list', true);
    }

    public function attributes()
    {
        return $this->belongsToMany(PropertyAttribute::class, 'property_type_attributes', 'property_type_id', 'attribute_id')
            ->withPivot('show_in_list', 'show_in_filter')
            ->withTimestamps();
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'property_type_id');
    }
}
