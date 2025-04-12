<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyVerification>
 */
class PropertyVerificationFactory extends Factory
{
    public function definition(): array
    {
        $submitter = User::inRandomOrder()->first();
        $validator = User::inRandomOrder()->first();
        $property = Property::inRandomOrder()->first();

        $state = $this->faker->randomElement(['pending', 'approved', 'rejected']);

        return [
            'property_id' => $property?->id,
            'state' => $state,
            'documentation' => $this->faker->url(),
            'submission_date' => now()->subDays(rand(5, 20)),
            'validation_date' => $state === 'pending' ? null : now()->subDays(rand(0, 4)),
            'submitted_by' => $submitter?->id,
            'validated_by' => $state === 'pending' ? null : $validator?->id,
        ];
    }
}
