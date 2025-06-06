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
            Advertisement::factory()->create([
                'property_id' => $property->id,
                'created_by' => $property->created_by,
            ]);
        }
    }
}
