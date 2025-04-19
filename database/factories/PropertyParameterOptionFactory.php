<?php

namespace Database\Factories;

use App\Models\PropertyAttributeOption;
use App\Models\PropertyParameter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyParameterOption>
 */
class PropertyParameterOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_parameter_id' => PropertyParameter::factory(),
            'property_attribute_option_id' => PropertyAttributeOption::factory(),
        ];
    }
}
