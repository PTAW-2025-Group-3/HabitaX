<?php

namespace Database\Factories;

use App\Models\PropertyAttribute;
use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyTypeAttribute>
 */
class PropertyTypeAttributeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'property_type' => PropertyType::inRandomOrder()->first()?->id,
            'attribute_id' => PropertyAttribute::inRandomOrder()->first()?->id,
            'required' => $this->faker->boolean(60),
        ];
    }
}
