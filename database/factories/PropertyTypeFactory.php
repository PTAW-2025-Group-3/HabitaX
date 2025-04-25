<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyType>
 */
class PropertyTypeFactory extends Factory
{
    public function definition(): array
    {
        $iconsPath = 'icons/';
        $icons = Storage::disk('public')->files($iconsPath);

        if (count($icons) > 20) {
            // Select a random icon from the existing ones
            $fileName = $icons[array_rand($icons)];
        } else {
            // Fetch a new icon from the URL
            $seed = fake()->uuid;
            $fileName = $iconsPath . 'icon_' . $seed . '.svg';
            $url = "https://api.dicebear.com/7.x/icons/svg?seed={$seed}";

            $response = Http::get($url);

            if ($response->ok()) {
                Storage::disk('public')->put($fileName, $response->body());
            }
        }

        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(10),
            'icon_path' => $fileName,
            'is_active' => $this->faker->boolean(),
        ];
    }
}
