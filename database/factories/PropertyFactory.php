<?php

namespace Database\Factories;

use App\Models\Parish;
use App\Models\PropertyType;
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

        return [
            'title' => $this->faker->sentence(3),
            'country' => 'Portugal',
            'total_area' => $this->faker->randomFloat(2, 50, 500),
            'is_active' => true,
            'is_verified' => false,

            // Foreign keys com dados reais e o mesmo user para created/updated
            'property_type_id' => PropertyType::inRandomOrder()->first()?->id,
            'parish_id' => Parish::inRandomOrder()->first()?->id,
            'created_by' => $user?->id,
            'updated_by' => $user?->id,
        ];
    }
}
