<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyAttributeOption>
 */
class PropertyAttributeOptionFactory extends Factory
{
    public function definition(): array
    {
//        $seed = fake()->uuid;
//        $fileName = 'icon_' . $seed . '.svg';
//        $url = "https://api.dicebear.com/7.x/icons/svg?seed={$seed}";
//
//        $response = Http::get($url);
//
//        if ($response->ok()) {
//            Storage::disk('public')->put("icons/{$fileName}", $response->body());
//        }

        return [
            'name' => $this->faker->word(),
//            'icon_path' => "icons/{$fileName}",
        ];
    }
}
