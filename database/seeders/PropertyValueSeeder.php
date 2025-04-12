<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\PropertyAttributeType;
use App\Models\PropertyValue;

class PropertyValueSeeder extends Seeder
{
    public function run(): void
    {
        $properties = Property::all();

        foreach ($properties as $property) {
            // Buscar atributos aplicáveis ao type_property
            $attributeTypes = PropertyAttributeType::where('property_type', $property->type_property)->get();

            foreach ($attributeTypes as $attrType) {
                // Evitar duplicações
                if (PropertyValue::where('property_id', $property->id)
                    ->where('attribute_id', $attrType->attribute_id)->exists()) {
                    continue;
                }

                // Gerar valor consoante o tipo
                $attribute = $attrType->attribute;
                $value = null;

                switch ($attribute->type) {
                    case 'number':
                        $value = fake()->numberBetween($attribute->minimal_value ?? 0, $attribute->maximal_value ?? 10);
                        break;
                    case 'boolean':
                        $value = fake()->boolean();
                        break;
                    case 'text':
                        $value = fake()->text($attribute->max_char ?? 100);
                        break;
                    case 'select':
                        $value = fake()->randomElement($attribute->options ?? []);
                        break;
                    default:
                        $value = 'N/A';
                }

                PropertyValue::create([
                    'property_id' => $property->id,
                    'attribute_id' => $attribute->id,
                    'value' => (string) $value,
                ]);
            }
        }
    }
}
