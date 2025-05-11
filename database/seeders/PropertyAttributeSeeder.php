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

            $count = fake()->numberBetween(10, 20);

            for ($i = 0; $i < $count; $i++) {
                $data = [
                    'name' => fake()->unique()->word(),
                    'description' => fake()->sentence(),
                    'type' => $type,
                    'is_active' => fake()->boolean(90),
                    'is_required' => fake()->boolean(),
                ];

                switch ($type) {
                    case AttributeType::TEXT->value:
                        $min = fake()->numberBetween(5, 20);
                        $data['min_length'] = $min;
                        $data['max_length'] = fake()->numberBetween($min + 5, $min + 50);
                        break;

                    case AttributeType::LONG_TEXT->value:
                        $data['min_length'] = fake()->numberBetween(10, 30);
                        $data['max_length'] = $data['min_length'] + fake()->numberBetween(100, 255);
                        break;

                    case AttributeType::INT->value:
                        $data['min_value'] = fake()->numberBetween(0, 50);
                        $data['max_value'] = fake()->numberBetween(51, 100);
                        $data['unit'] = fake()->word();
                        break;

                    case AttributeType::FLOAT->value:
                        $data['min_value'] = fake()->randomFloat(2, 0, 50);
                        $data['max_value'] = fake()->randomFloat(2, 51, 100);
                        $data['unit'] = fake()->word();
                        break;

                    case AttributeType::DATE->value:
                        $data['min_date'] = fake()->dateTimeBetween('-1 year')->format('d-m-Y');
                        $data['max_date'] = fake()->dateTimeBetween('now', '+1 year')->format('d-m-Y');
                        break;

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

                $attribute = PropertyAttribute::create($data);
            }
        }
    }
}
