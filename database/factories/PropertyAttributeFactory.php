<?php

namespace Database\Factories;

use App\AttributeType;
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
            'type' => $this->faker->randomElement(AttributeType::cases())->value,
            'is_active' => $this->faker->boolean(90),
            'is_required' => $this->faker->boolean(50),
            'minimal' => null,
            'maximal' => null,
            'unit' => null,
        ];
    }
}
