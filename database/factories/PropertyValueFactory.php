<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\PropertyAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyValue>
 */
class PropertyValueFactory extends Factory
{
    public function definition(): array
    {
        $property = Property::inRandomOrder()->first();
        $attribute = PropertyAttribute::inRandomOrder()->first();

        $value = null;

        if ($attribute) {
            switch ($attribute->type) {
                case 'number':
                    $value = $this->faker->numberBetween(
                        $attribute->minimal_value ?? 0,
                        $attribute->maximal_value ?? 10
                    );
                    break;

                case 'boolean':
                    $value = $this->faker->boolean();
                    break;

                case 'text':
                    $value = $this->faker->text($attribute->max_char ?? 100);
                    break;

                case 'select':
                    $value = $this->faker->randomElement($attribute->options ?? []);
                    break;

                default:
                    $value = 'N/A';
            }
        }

        return [
            'property_id' => $property?->id,
            'attribute_id' => $attribute?->id,
            'value' => (string) $value,
        ];
    }
}
