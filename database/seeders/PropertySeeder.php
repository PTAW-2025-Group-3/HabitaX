<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $imageFolder = storage_path('property-seed-images');
        $extensions = ['jpg', 'jpeg', 'png', 'webp'];
        $imageFiles = [];

        foreach ($extensions as $ext) {
            $imageFiles = array_merge($imageFiles, glob("{$imageFolder}/*.{$ext}"));
        }

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
