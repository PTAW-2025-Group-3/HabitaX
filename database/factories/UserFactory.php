<?php

namespace Database\Factories;

use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'telephone' => fake()->numerify('91#######'),
            'profilePhoto_url' => fake()->imageUrl(200, 200, 'people'),
            'userType' => fake()->randomElement(['user', 'moderator', 'admin']),
            'advertiserNumber' => null,
            'staffNumber' => null,
            'bio' => fake()->paragraph(),
            'email_notifications' => true,
            'message_notifications' => true,
            'public_profile' => true,
            'show_email' => false,
            'state' => fake()->randomElement(['active', 'suspended', 'banned', 'archived']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
