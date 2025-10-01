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

        if (\App\Models\Property::count() > 200) {
            $propertyTypeId = \App\Models\PropertyType::where('name', 'Moradias')->first()?->id;

            if (!$propertyTypeId) {
                throw new \Exception('PropertyType "Moradias" not found. Please seed it before running PropertyFactory.');
            }
        } else {
            $propertyTypeId = \App\Models\PropertyType::inRandomOrder()->first()?->id;

            if (!$propertyTypeId) {
                throw new \Exception('No PropertyType found. Please seed PropertyTypes before running PropertyFactory.');
            }
        }

        return [
            'title' => $this->faker->sentence(),
            'country' => 'Portugal',
            'total_area' => $this->faker->randomFloat(2, 50, 500),
            'is_active' => true,
            'is_verified' => false,

            'property_type_id' => $propertyTypeId,
            'parish_id' => $activeParishIds->random(),
            'created_by' => $user?->id,
            'updated_by' => $user?->id,
        ];
    }
}
