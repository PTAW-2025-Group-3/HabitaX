<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\PropertyTypeAttribute;
use App\Models\PropertyParameter;

class PropertyValueSeeder extends Seeder
{
    public function run(): void
    {
        $properties = Property::all();

        foreach ($properties as $property) {
            $attributeTypes = PropertyTypeAttribute::where('property_type_id', $property->type_property)->get();

            $usedAttributeIds = [];

            // First pass - assign one value per unique attribute
            foreach ($attributeTypes as $type) {
                $attr = $type->attribute;

                if (in_array($attr->id, $usedAttributeIds)) {
                    continue;
                }

                $this->createPropertyValue($property->id, $attr->id);
                $usedAttributeIds[] = $attr->id;
            }

            // Second pass - randomly assign more until there are 5
            while (count($usedAttributeIds) < 5) {
                $remaining = $attributeTypes->whereNotIn('attribute_id', $usedAttributeIds);

                if ($remaining->isEmpty()) {
                    break;
                }

                $randomAttr = $remaining->random()->attribute;
                $this->createPropertyValue($property->id, $randomAttr->id);
                $usedAttributeIds[] = $randomAttr->id;
            }
        }
    }

    private function createPropertyValue(int $propertyId, int $attributeId): void
    {
        PropertyParameter::create([
            'property_id' => $propertyId,
            'property_attribute_id' => $attributeId,
            'value' => (string) $this->generateValueFromId($attributeId),
        ]);
    }

    private function generateValueFromId(int $attributeId): string
    {
        // Customize based on attribute ID or type if needed
        return rand(1, 100); // Example stub
    }
}
