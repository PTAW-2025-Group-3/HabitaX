<?php

namespace Database\Factories;

use App\Models\PropertyAttribute;
use App\Models\TypeProperty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyAttributeType>
 */
class PropertyAttributeTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'property_type' => TypeProperty::inRandomOrder()->first()?->id,
            'attribute_id' => PropertyAttribute::inRandomOrder()->first()?->id,
            'required' => $this->faker->boolean(60),
        ];
    }
}
