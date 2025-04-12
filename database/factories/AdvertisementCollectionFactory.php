<?php

namespace Database\Factories;

use App\Models\Collection;
use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdvertisementCollection>
 */
class AdvertisementCollectionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'collection_id' => Collection::inRandomOrder()->first()?->id,
            'advertisement_id' => Advertisement::inRandomOrder()->first()?->id,
            'addedAt' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
