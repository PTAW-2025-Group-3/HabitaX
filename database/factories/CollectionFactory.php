<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true), // Ex: "Favoritos Lisboa"
            'description' => $this->faker->optional()->paragraph(),
            'is_public' => $this->faker->boolean(30), // 30% públicas
            'created_by' => User::inRandomOrder()->first()?->id,
        ];
    }
}
