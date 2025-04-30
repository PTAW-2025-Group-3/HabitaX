<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $imageFolder = storage_path('property-seed-images');
        $imageFiles = glob($imageFolder . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE);

        if (count($imageFiles) < 10) {
            throw new \Exception("Not enough images in {$imageFolder}");
        }

        Property::factory()->count(10)->create()->each(function ($property) use ($imageFiles) {
            $count = rand(5, 8);
            $randomFiles = collect($imageFiles)->random($count);

            foreach ($randomFiles as $path) {
                $property->addMedia($path)->preservingOriginal()->toMediaCollection('images');
            }
        });
    }
}
