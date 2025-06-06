<?php

namespace Database\Factories;

use App\Enums\AttributeType;
use App\Providers\PortugueseLoremProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyAttribute>
 */
class PropertyAttributeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => function () {
                $faker = $this->faker;

                $wordCount = $faker->numberBetween(1, 3);

                // полный список слов: короткие и длинные
                $allWords = array_merge(
                    [
                        'de', 'do', 'da', 'dos', 'das', 'e', 'em', 'no', 'na', 'com', 'sem', 'por', 'sob', 'a', 'o'
                    ],
                    PortugueseLoremProvider::$wordList ?? []
                );

                $longWords = array_filter($allWords, fn($w) => mb_strlen($w, 'UTF-8') >= 4);
                $longWords = array_values($longWords); // reindex

                if ($wordCount === 1) {
                    return $faker->unique()->randomElement($longWords);
                }

                return implode(' ', $faker->unique()->randomElements($allWords, $wordCount));
            },
            'description' => $this->faker->sentence(),
            'is_active' => $this->faker->boolean(90),
            'is_required' => $this->faker->boolean(),
        ];
    }

    public function withType(AttributeType $type): self
    {
        return $this->state(function (array $attributes) use ($type) {
            $data = ['type' => $type->value];

            switch ($type) {
                case AttributeType::TEXT:
                    $min = $this->faker->numberBetween(5, 20);
                    $data['min_length'] = $min;
                    $data['max_length'] = $this->faker->numberBetween($min + 5, $min + 50);
                    break;

                case AttributeType::LONG_TEXT:
                    $min = $this->faker->numberBetween(10, 30);
                    $data['min_length'] = $min;
                    $data['max_length'] = $min + $this->faker->numberBetween(100, 255);
                    break;

                case AttributeType::INT:
                    $data['min_value'] = $this->faker->numberBetween(0, 50);
                    $data['max_value'] = $this->faker->numberBetween(51, 100);
                    $data['unit'] = $this->faker->word();
                    break;

                case AttributeType::FLOAT:
                    $data['min_value'] = $this->faker->randomFloat(2, 0, 50);
                    $data['max_value'] = $this->faker->randomFloat(2, 51, 100);
                    $data['unit'] = $this->faker->word();
                    break;

                case AttributeType::DATE:
                    $data['min_date'] = $this->faker->dateTimeBetween('-1 year');
                    $data['max_date'] = $this->faker->dateTimeBetween('now', '+1 year');
                    break;

                case AttributeType::SELECT_SINGLE:
                    // options will be handled after creation
                    break;

                case AttributeType::SELECT_MULTIPLE:
                    // options and min/max will be handled after creation
                    break;
            }

            return $data;
        });
    }
}
