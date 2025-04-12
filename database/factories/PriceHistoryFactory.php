<?php

namespace Database\Factories;

use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PriceHistory>
 */
class PriceHistoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'advertisement_id' => Advertisement::inRandomOrder()->first()?->id,
            'price' => $this->faker->randomFloat(2, 50000, 750000),
            'register_date' => $this->faker->dateTimeBetween('-2 months', 'now'),
        ];
    }
}
