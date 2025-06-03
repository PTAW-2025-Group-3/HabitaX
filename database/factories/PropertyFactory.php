<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();

        // Obter todas as freguesias pertencentes a distritos ativos
        $activeParishIds = \App\Models\Parish::whereHas('municipality.district', function ($query) {
            $query->where('is_active', true);
        })->pluck('id');

        return [
            'title' => $this->faker->sentence(),
            'country' => 'Portugal',
            'total_area' => $this->faker->randomFloat(2, 50, 500),
            'is_active' => true,
            'is_verified' => false,

            'property_type_id' => \App\Models\PropertyType::inRandomOrder()->first()?->id,
            'parish_id' => $activeParishIds->random(),
            'created_by' => $user?->id,
            'updated_by' => $user?->id,
        ];
    }
}
