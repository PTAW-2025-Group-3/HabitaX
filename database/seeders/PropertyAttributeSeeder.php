<?php

namespace Database\Seeders;

use App\Enums\AttributeType;
use App\Models\PropertyAttribute;
use App\Models\PropertyAttributeOption;
use Illuminate\Database\Seeder;

class PropertyAttributeSeeder extends Seeder
{
    public function run(): void
    {
        foreach (AttributeType::cases() as $typeCase) {
            $type = $typeCase;

            $count = fake()->numberBetween(10, 20);

            for ($i = 0; $i < $count; $i++) {
                $attribute = PropertyAttribute::factory()
                    ->withType($type)
                    ->create();

                switch ($type) {
                    case AttributeType::SELECT_SINGLE:
                        PropertyAttributeOption::factory()->count(rand(3, 10))->create([
                            'attribute_id' => $attribute->id,
                        ]);
                        break;

                    case AttributeType::SELECT_MULTIPLE:
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
