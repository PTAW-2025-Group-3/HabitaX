<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collection;
use App\Models\Advertisement;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdvertisementCollectionSeeder extends Seeder
{
    public function run(): void
    {
        $collections = Collection::all();
        $advertisements = Advertisement::all();

        if ($collections->isEmpty() || $advertisements->isEmpty()) {
            $this->command->warn('É necessário ter coleções e anúncios antes de associar.');
            return;
        }

        // Associar 2 a 5 anúncios por coleção
        foreach ($collections as $collection) {
            $randomAds = $advertisements->random(rand(2, 5));

            foreach ($randomAds as $ad) {
                DB::table('advertisement_collection')->updateOrInsert(
                    [
                        'collection_id' => $collection->id,
                        'advertisement_id' => $ad->id,
                    ],
                    [
                        'addedAt' => Carbon::now()->subDays(rand(0, 30)),
                    ]
                );
            }
        }
    }
}
