<?php

namespace Database\Seeders;

use App\Models\PriceHistory;
use Carbon\Carbon;
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

        // Create advertisements for all properties
        foreach ($properties as $property) {
            if (Advertisement::where('property_id', $property->id)->exists()) {
                continue;
            }

            $ad = Advertisement::factory()->create([
                'property_id' => $property->id,
                'created_by' => $property->created_by,
            ]);

            // Price history generation
            $numRegistos = rand(3, 10);
            $startPrice = $ad->price;
            $date = Carbon::now()->subDays($numRegistos * 10);

            for ($i = 0; $i < $numRegistos; $i++) {
                $fluctuation = $ad->transaction_type == 'rent' ? rand(-200, 500) : rand(-5000, 10000);
                PriceHistory::create([
                    'advertisement_id' => $ad->id,
                    'price' => $startPrice + $fluctuation,
                    'register_date' => $date->copy()->addDays($i * 10),
                ]);
            }
        }
    }
}
