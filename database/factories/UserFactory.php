<?php

namespace Database\Factories;

use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
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
        $picturesPath = 'pictures/';
        $pictures = Storage::disk('public')->files($picturesPath);
        if (count($pictures) > 20) {
            // Select a random picture from the existing ones
            $fileName = $pictures[array_rand($pictures)];
        } else {
            // Fetch a new picture from the URL
            $seed = fake()->uuid;
            $fileName = $picturesPath . 'picture_' . $seed . '.jpeg';
            $url = "https://picsum.photos/200/200?random={$seed}";

            $response = Http::get($url);

            if ($response->ok()) {
                Storage::disk('public')->put($fileName, $response->body());
            }
        }

        return [
            'name' => fake()->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'telephone' => fake()->numerify('91#######'),
            'profile_picture_path' => $fileName,
            'user_type' => fake()->randomElement(['user', 'moderator', 'admin']),
            'advertiser_number' => null,
            'staff_number' => null,
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
