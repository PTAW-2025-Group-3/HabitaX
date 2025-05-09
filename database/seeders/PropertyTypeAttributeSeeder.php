<?php

namespace Database\Seeders;

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
            $min = max(1, floor($propertyAttributes->count() * 0.3));
            $max = max($min, $propertyAttributes->count());
            $attributes = $propertyAttributes->random(rand($min, $max))->pluck('id');

            foreach ($attributes as $attributeId) {
                PropertyTypeAttribute::create([
                    'property_type_id' => $propertyType->id,
                    'attribute_id' => $attributeId,
                ]);
            }
        }
    }
}
