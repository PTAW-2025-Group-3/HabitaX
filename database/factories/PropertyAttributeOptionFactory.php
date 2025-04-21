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
            'icon_url' => $this->generateIconUrl(),
        ];
    }

    private function generateIconUrl(): string
    {
        return 'https://picsum.photos/200/200?random=' . rand(1, 1000);
    }
}
