<?php

namespace Database\Factories;

use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Municipality>
 */
class MunicipalityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $municipios = [
            'Lisboa', 'Porto', 'Sintra', 'Vila Nova de Gaia', 'Loures',
            'Amadora', 'Braga', 'Oeiras', 'Matosinhos', 'Gondomar',
            'Guimarães', 'Cascais', 'Almada', 'Coimbra', 'Seixal'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($municipios),
            'district_id' => District::factory(),
        ];
    }
}
