<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Advertisement;
use App\Models\Property;

class AdvertisementSeeder extends Seeder
{
    public function run(): void
    {
        // Retrieve all properties
        $properties = Property::all();

        if ($properties->isEmpty()) {
            $this->command->warn('No properties found. Run the PropertySeeder first.');
            return;
        }

        $this->command->info("Found {$properties->count()} properties.");

        // Create advertisements for all properties
        foreach ($properties as $property) {
            Advertisement::create([
                'reference' => fake()->unique()->numberBetween(100000, 999999),
                'title' => fake()-> sentence(6),
                'description' => fake()->paragraph(3),
                'transaction_type' => fake()->randomElement(['sale', 'rent']),
                'price' => fake()->randomFloat(2, 10000, 750000),
//                'state' => fake()->randomElement(['pending', 'active', 'archived']),
                'state' => fake()->randomElement(['active']),
                'property_id' => $property->id,
            ]);
        }
    }
}
