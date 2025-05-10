<?php

namespace Database\Seeders;

use App\Enums\AttributeType;
use App\Models\PropertyAttributeOption;
use App\Models\PropertyParameterOption;
use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\PropertyTypeAttribute;
use App\Models\PropertyParameter;
use Illuminate\Support\Facades\Log;

class PropertyParameterSeeder extends Seeder
{
    public function run(): void
    {
        $properties = Property::all();

        foreach ($properties as $property) {
            $propertyTypeAttributes = PropertyTypeAttribute::where('property_type_id', $property->property_type_id)->get();
            $propertyId = $property->id;

            foreach ($propertyTypeAttributes as $attribute) {
                $attributeId = $attribute->attribute_id;

                switch ($attribute->attribute->type) {
                    case AttributeType::TEXT:
                    case AttributeType::LONG_TEXT:
                        PropertyParameter::create([
                            'property_id' => $propertyId,
                            'attribute_id' => $attributeId,
                            'text_value' => fake()->text(
                                max(5, rand($attribute->min_length ?? 0, $attribute->max_length ?? 255))
                            )
                        ]);
                        break;

                    case AttributeType::INT:
                        PropertyParameter::create([
                            'property_id' => $propertyId,
                            'attribute_id' => $attributeId,
                            'int_value' => fake()->numberBetween(
                                $attribute->min_value ?? 0,
                                $attribute->max_value ?? 1000
                            )
                        ]);
                        break;

                    case AttributeType::FLOAT:
                        PropertyParameter::create([
                            'property_id' => $propertyId,
                            'attribute_id' => $attributeId,
                            'float_value' => fake()->randomFloat(
                                2,
                                $attribute->min_value ?? 0,
                                $attribute->max_value ?? 1000
                            )
                        ]);
                        break;

                    case AttributeType::BOOLEAN:
                        PropertyParameter::create([
                            'property_id' => $propertyId,
                            'attribute_id' => $attributeId,
                            'boolean_value' => fake()->boolean()
                        ]);
                        break;

                    case AttributeType::SELECT_SINGLE:
                        $options = PropertyAttributeOption::where('attribute_id', $attributeId)->get();
                        if (empty($options)) {
                            Log::warning('No options found for attribute', ['attribute_id' => $attributeId]);
                        }
                        if (!empty($options)) {
                            PropertyParameter::create([
                                'property_id' => $propertyId,
                                'attribute_id' => $attributeId,
                                'select_value' => fake()->randomElement($options)->id
                            ]);
                        }
                        break;

                    case AttributeType::SELECT_MULTIPLE:
                        $options = PropertyAttributeOption::where('attribute_id', $attributeId)->get();
                        if (empty($options)) {
                            Log::warning('No options found for attribute', ['attribute_id' => $attributeId]);
                        }
                        if (!empty($options)) {
                            $selectedOptions = fake()->randomElements($options, rand(
                                $attribute->min_options ?? 0,
                                $attribute->max_options ?? count($options))
                            );

                            $parameter = PropertyParameter::create([
                                'property_id' => $propertyId,
                                'attribute_id' => $attributeId,
                            ]);
                            foreach ($selectedOptions as $option) {
                                PropertyParameterOption::create([
                                    'parameter_id' => $parameter->id,
                                    'option_id' => $option->id
                                ]);
                            }
                        }
                        break;

                    case AttributeType::DATE:
                        PropertyParameter::create([
                            'property_id' => $propertyId,
                            'attribute_id' => $attributeId,
                            'date_value' => fake()->dateTimeBetween(
                                $attribute->min_date ?? '-30 years',
                                $attribute->max_date ?? 'now'
                            )
                        ]);
                        break;

                    default:
                        PropertyParameter::create([
                            'property_id' => $propertyId,
                            'attribute_id' => $attributeId,
                            'value' => fake()->text()
                        ]);
                        break;
                }
            }
        }
    }
}
