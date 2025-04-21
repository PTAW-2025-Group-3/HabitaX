<?php

namespace Database\Seeders;

use App\Enums\AttributeType;
use App\Models\PropertyAttributeOption;
use App\Models\PropertyType;
use Illuminate\Database\Seeder;
use App\Models\PropertyAttribute;

class PropertyAttributeSeeder extends Seeder
{
    public function run(): void
    {
        foreach (AttributeType::cases() as $typeCase) {
            $type = $typeCase->value;

            // Generate 2 to 4 attributes for each type
            $count = fake()->numberBetween(1, 3);

            for ($i = 0; $i < $count; $i++) {
                $attribute = PropertyAttribute::factory()->create([
                    'type' => $type,
                ]);

                // Create options only if the type is "select single" or "select multiple"
                if (in_array($type, [AttributeType::SELECT_SINGLE->value, AttributeType::SELECT_MULTIPLE->value])) {
                    PropertyAttributeOption::factory()->count(rand(3, 10))->create([
                        'property_attribute_id' => $attribute->id,
                    ]);
                }
            }
        }
    }
}
