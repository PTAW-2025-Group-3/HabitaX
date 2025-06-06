<?php

namespace Database\Factories;

use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactRequest>
 */
class ContactRequestFactory extends Factory
{
    public function definition(): array
    {
        $faker = $this->faker;
        $advertisement = Advertisement::inRandomOrder()->first();

        $isAuthenticated = $this->faker->boolean(50);
        $user = $isAuthenticated ? User::inRandomOrder()->first() : null;

        return [
            'advertisement_id' => $advertisement?->id,
            'created_by' => $user?->id,
            'name' => $user?->name ?? $faker->firstName() . ' ' . $faker->lastName(),
            'email' => $user?->email ?? $faker->safeEmail(),
            'telephone' => $faker->phoneNumber(),
            'message' => $faker->paragraph(),
            'state' => $faker->randomElement(['unread', 'read', 'archived']),
        ];
    }
}
