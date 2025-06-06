<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertisement>
 */
class AdvertisementFactory extends Factory
{
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();

        $transactionType = $this->faker->randomElement(['sale', 'rent']);

        $price = $transactionType === 'rent'
            ? $this->faker->randomFloat(2, 200, 3000) // preço para aluguer
            : $this->faker->randomFloat(2, 50000, 750000); // preço para venda

        return [
            'reference' => $this->faker->unique()->numberBetween(100000, 999999),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'transaction_type' => $transactionType,
            'price' => $price,
            'is_published' => $this->faker->boolean(80),
            'is_suspended' => $this->faker->boolean(10),
            'property_id' => Property::inRandomOrder()->first()?->id,
            'created_by' => $user?->id,
            'updated_by' => $user?->id,
        ];
    }
}
