<?php

namespace Database\Seeders;

use App\Enums\AttributeType;
use App\Models\Property;
use App\Models\PropertyAttributeOption;
use App\Models\PropertyParameter;
use App\Models\PropertyParameterOption;
use App\Models\PropertyTypeAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PropertyParameterSeeder extends Seeder
{
    public function run(): void
    {
        $properties = Property::all();

        foreach ($properties as $property) {
            $typeAttributes = PropertyTypeAttribute::with('attribute')
                ->where('property_type_id', $property->property_type_id)
                ->get();

            foreach ($typeAttributes as $pta) {
                $attribute = $pta->attribute;

                switch ($attribute->type) {
                    case AttributeType::SELECT_SINGLE:
                        $options = PropertyAttributeOption::where('attribute_id', $attribute->id)->get();
                        if ($options->isEmpty()) {
                            Log::warning('No options found for attribute', ['attribute_id' => $attribute->id]);
                            break;
                        }

                        PropertyParameter::factory()->create([
                            'attribute_id' => $attribute->id,
                            'property_id' => $property->id,
                            'select_value' => fake()->randomElement($options->pluck('id')->toArray()),
                        ]);
                        break;

                    case AttributeType::SELECT_MULTIPLE:
                        $options = PropertyAttributeOption::where('attribute_id', $attribute->id)->get();
                        if ($options->isEmpty()) {
                            Log::warning('No options found for attribute', ['attribute_id' => $attribute->id]);
                            break;
                        }

                        $selected = fake()->randomElements($options->all(), rand(
                            $attribute->min_options ?? 1,
                            $attribute->max_options ?? count($options)
                        ));

                        $parameter = PropertyParameter::factory()
                            ->withAttribute([
                                'attribute' => $attribute,
                                'property_id' => $property->id,
                            ])
                            ->create();

                        foreach ($selected as $option) {
                            PropertyParameterOption::create([
                                'parameter_id' => $parameter->id,
                                'option_id' => $option->id
                            ]);
                        }
                        break;

                    default:
                        PropertyParameter::factory()
                            ->withAttribute([
                                'attribute' => $attribute,
                                'property_id' => $property->id,
                            ])
                            ->create();
                        break;
                }
            }
        }
    }
}
