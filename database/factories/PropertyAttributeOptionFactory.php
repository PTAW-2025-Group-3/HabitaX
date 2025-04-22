<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyAttributeOption>
 */
class PropertyAttributeOptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'order' => $this->faker->randomNumber(2),
            'icon_url' => 'https://picsum.photos/seed/' . $this->faker->randomNumber(3) . '/200/200',
        ];
    }
}
