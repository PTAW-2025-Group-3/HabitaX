<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\District>
 */
class DistrictFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $distritos = [
            'Lisboa', 'Porto', 'Braga', 'Setúbal', 'Aveiro', 'Coimbra', 'Leiria',
            'Faro', 'Viseu', 'Santarém', 'Viana do Castelo', 'Vila Real',
            'Castelo Branco', 'Guarda', 'Évora', 'Beja', 'Bragança', 'Portalegre'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($distritos),
        ];

    }
}
