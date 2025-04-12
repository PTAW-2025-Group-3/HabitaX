<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyAttribute>
 */
class PropertyAttributeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'type' => $this->faker->randomElement(['text', 'number', 'boolean', 'select']),
            'isActive' => $this->faker->boolean(90),
            'minimal_value' => null,
            'maximal_value' => null,
            'min_char' => null,
            'max_char' => null,
            'options' => null,
        ];
    }
}
