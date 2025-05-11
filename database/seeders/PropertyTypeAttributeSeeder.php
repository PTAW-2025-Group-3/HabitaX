<?php

namespace Database\Seeders;

use App\Enums\AttributeType;
use App\Models\GlobalVariable;
use Illuminate\Database\Seeder;
use App\Models\PropertyType;
use App\Models\PropertyAttribute;
use App\Models\PropertyTypeAttribute;

class PropertyTypeAttributeSeeder extends Seeder
{
    public function run(): void
    {
        $propertyTypes = PropertyType::all();
        $propertyAttributes = PropertyAttribute::all();

        foreach ($propertyTypes as $propertyType) {
            $min = max(1, floor($propertyAttributes->count() * 0.2));
            $max = max($min, $propertyAttributes->count() * 0.4);
            $attributes = $propertyAttributes->random(rand($min, $max))->pluck('id');

            foreach ($attributes as $attributeId) {
                PropertyTypeAttribute::create([
                    'property_type_id' => $propertyType->id,
                    'attribute_id' => $attributeId,
                ]);
            }
        }

        $this->command->info('PropertyTypeAttributeSeeder: Property type attributes seeded successfully.');
        $maxFilter = GlobalVariable::where('code', 'max_attributes_filter')->first();
        $maxList = GlobalVariable::where('code', 'max_attributes_list')->first();
        $requiredAttributes = PropertyAttribute::where('is_required', 1)->pluck('id');
        foreach ($propertyTypes as $propertyType) {
            $propertyTypeAttributes = PropertyTypeAttribute::whereIn('attribute_id', $requiredAttributes)
                ->where('property_type_id', $propertyType->id)
                ->with('attribute') // Eager-load the attribute relationship
                ->get()
                ->shuffle(); // Randomize the order

            $filterCount = 0;
            $listCount = 0;

            foreach ($propertyTypeAttributes as $propertyTypeAttribute) {
                if (!$propertyTypeAttribute->attribute)
                {
                    continue;
                }

                if ($propertyTypeAttribute->attribute->type == AttributeType::LONG_TEXT ||
                    $propertyTypeAttribute->attribute->type == AttributeType::TEXT) {
                    continue; // Skip long text and text attributes
                }

                if ($filterCount >= $maxFilter->value && $listCount >= $maxList->value) {
                    break; // Stop if both limits are reached
                }

                if ($filterCount < $maxFilter->value) {
                    $propertyTypeAttribute->show_in_filter = true;
                    $filterCount++;
                }

                if ($listCount < $maxList->value && $propertyTypeAttribute->attribute->type != AttributeType::SELECT_MULTIPLE) {
                    $propertyTypeAttribute->show_in_list = true;
                    $listCount++;
                }

                $propertyTypeAttribute->save();
            }
        }
    }
}
