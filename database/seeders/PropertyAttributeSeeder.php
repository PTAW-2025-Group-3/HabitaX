<?php

namespace Database\Seeders;

use App\Enums\AttributeType;
use App\Models\PropertyAttributeOption;
use Illuminate\Database\Seeder;
use App\Models\PropertyAttribute;

class PropertyAttributeSeeder extends Seeder
{
    public function run(): void
    {
        foreach (AttributeType::cases() as $typeCase) {
            $type = $typeCase->value;

            $count = fake()->numberBetween(3, 6);

            for ($i = 0; $i < $count; $i++) {
                $attribute = PropertyAttribute::factory()->create([
                    'type' => $type,
                ]);

                // Generate options for select types
                switch ($type) {
                    case AttributeType::SELECT_SINGLE->value:
                        PropertyAttributeOption::factory()->count(rand(3, 10))->create([
                            'property_attribute_id' => $attribute->id,
                        ]);
                        break;

                    case AttributeType::SELECT_MULTIPLE->value:
                        PropertyAttributeOption::factory()->count(rand(3, 10))->create([
                            'property_attribute_id' => $attribute->id,
                        ]);
                        $attribute->update([
                            'min_options' => fake()->numberBetween(0, 2),
                            'max_options' => fake()->numberBetween(4, 8),
                        ]);
                        break;
                }
            }
        }
    }
}
