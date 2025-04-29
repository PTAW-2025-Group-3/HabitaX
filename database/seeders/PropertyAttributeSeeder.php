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
                            'attribute_id' => $attribute->id,
                        ]);
                        break;

                    case AttributeType::SELECT_MULTIPLE->value:
                        $optionCount = rand(5, 15);

                        PropertyAttributeOption::factory()->count($optionCount)->create([
                            'attribute_id' => $attribute->id,
                        ]);

                        $attribute->update([
                            'min_options' => fake()->numberBetween(0, min(2, $optionCount)),
                            'max_options' => fake()->numberBetween(4, $optionCount),
                        ]);
                        break;
                }
            }
        }
    }
}
