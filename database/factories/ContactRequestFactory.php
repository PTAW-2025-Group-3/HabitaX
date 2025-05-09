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
        $user = User::inRandomOrder()->first();
        $advertisement = Advertisement::inRandomOrder()->first();

        return [
            'advertisement_id' => $advertisement?->id,
            'created_by' => $user?->id,
            'name' => $user?->name ?? $this->faker->name(),
            'email' => $user?->email ?? $this->faker->safeEmail(),
            'telephone' => $this->faker->numerify('9########'),
            'message' => $this->faker->paragraph(),
            'state' => $this->faker->randomElement(['unread', 'read', 'archived']),
        ];
    }
}
