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
            $attributes = $propertyAttributes->random(rand(1, 3))->pluck('id');

            foreach ($attributes as $attributeId) {
                PropertyTypeAttribute::create([
                    'property_type_id' => $propertyType->id,
                    'property_attribute_id' => $attributeId,
                    'is_required' => rand(0, 1) === 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}
