<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertisement>
 */
class AdvertisementFactory extends Factory
{
    public function definition(): array
    {
        return [
            'reference' => $this->faker->unique()->numberBetween(100000, 999999),
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(3),
            'transaction_type' => $this->faker->randomElement(['sale', 'rent']),
            'price' => $this->faker->randomFloat(2, 10000, 750000),
            'state' => $this->faker->randomElement(['pending', 'active', 'archived']),
            'property_id' => Property::inRandomOrder()->first()?->id,
        ];
    }
}
