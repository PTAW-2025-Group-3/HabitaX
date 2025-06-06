<?php

namespace Database\Factories;

use App\Enums\AttributeType;
use App\Models\PropertyParameter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PropertyParameter>
 */
class PropertyParameterFactory extends Factory
{
    public function definition(): array
    {
        return []; // Значения должны быть заданы через state() или в сидере
    }

    public function withAttribute(array $args): self
    {
        $faker = $this->faker;

        $attribute = $args['attribute'];
        $propertyId = $args['property_id'];
        $attributeId = $attribute->id;

        $data = [
            'property_id' => $propertyId,
            'attribute_id' => $attributeId,
        ];

        switch ($attribute->type) {
            case AttributeType::TEXT:
            case AttributeType::LONG_TEXT:
                $min = $attribute->min_length ?? 5;
                $max = $attribute->max_length ?? 255;
                $data['text_value'] = mb_convert_encoding(
                    $faker->text($faker->numberBetween($min, $max)), 'UTF-8', 'UTF-8'
                );
            break;

            case AttributeType::INT:
                $data['int_value'] = $faker->numberBetween(
                    $attribute->min_value ?? 0,
                    $attribute->max_value ?? 1000
                );
                break;

            case AttributeType::FLOAT:
                $data['float_value'] = $faker->randomFloat(
                    2,
                    $attribute->min_value ?? 0,
                    $attribute->max_value ?? 1000
                );
                break;

            case AttributeType::BOOLEAN:
                $data['boolean_value'] = $faker->boolean();
                break;

            case AttributeType::DATE:
                $data['date_value'] = $faker->dateTimeBetween(
                    $attribute->min_date ?? '-30 years',
                    $attribute->max_date ?? 'now'
                );
                break;

            case AttributeType::SELECT_MULTIPLE:
            case AttributeType::SELECT_SINGLE:
                // handled manually in seeder
                break;

            default:
                $data['value'] = $faker->text();
        }

        return $this->state($data);
    }
}
