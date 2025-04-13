<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::factory()->count(50)->create()->each(function ($property) {
            $property->update([
                'images' => json_encode([
                    "https://picsum.photos/seed/{$property->id}-1/600/400",
                    "https://picsum.photos/seed/{$property->id}-2/600/400",
                    "https://picsum.photos/seed/{$property->id}-3/600/400",
                    "https://picsum.photos/seed/{$property->id}-4/600/400",
                    "https://picsum.photos/seed/{$property->id}-5/600/400"
                ]),
            ]);
        });
    }
}
