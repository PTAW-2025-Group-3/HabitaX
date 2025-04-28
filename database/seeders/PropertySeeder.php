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
                'images' => collect(range(1, rand(5, 10)))->map(function ($index) use ($property) {
                    return "https://picsum.photos/seed/{$property->id}-{$index}/600/400";
                })->toArray(),
            ]);
        });
    }
}
