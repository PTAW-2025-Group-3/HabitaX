<?php

namespace Database\Factories;

use App\Enums\AttributeType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyAttribute>
 */
class PropertyAttributeFactory extends Factory
{
    public function definition(): array
    {
        $type = $this->faker->randomElement(AttributeType::cases())->value;

        $data = [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'type' => $type,
            'is_active' => $this->faker->boolean(90),
            'is_required' => $this->faker->boolean(),
        ];

        switch ($type) {
            case AttributeType::TEXT->value:
            case AttributeType::LONG_TEXT->value:
                $data['min_length'] = $this->faker->numberBetween(1, 50);
                $data['max_length'] = $this->faker->numberBetween(51, 255);
                break;

            case AttributeType::INT->value:
                $data['min_value'] = $this->faker->numberBetween(0, 50);
                $data['max_value'] = $this->faker->numberBetween(51, 100);
                $data['unit'] = $this->faker->word();
                break;

            case AttributeType::FLOAT->value:
                $data['min_value'] = $this->faker->randomFloat(2, 0, 50);
                $data['max_value'] = $this->faker->randomFloat(2, 51, 100);
                $data['unit'] = $this->faker->word();
                break;

            case AttributeType::DATE->value:
                $data['min_date'] = $this->faker->dateTimeBetween('-1 year')->format('d-m-Y');
                $data['max_date'] = $this->faker->dateTimeBetween('now', '+1 year')->format('d-m-Y');
                break;

            case AttributeType::SELECT_SINGLE->value:
                break;

            case AttributeType::SELECT_MULTIPLE->value:
                $data['min_options'] = $this->faker->optional(0.8)->numberBetween(0, 2);
                $data['max_options'] = $this->faker->optional()->numberBetween(5, 8);
                break;
        }

        return $data;
    }
}
