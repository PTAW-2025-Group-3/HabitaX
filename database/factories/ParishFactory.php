<?php

namespace Database\Factories;

use App\Models\Municipality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parish>
 */
class ParishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $freguesias = [
            // Lisboa
            'Santa Maria Maior',
            'São Vicente',
            'Campo de Ourique',
            'Belém',
            'Benfica',
            // Porto
            'Bonfim',
            'Paranhos',
            'Cedofeita',
            'Lordelo do Ouro e Massarelos',
            'Campanhã',
            // Outros
            'Arroios',
            'Carnide',
            'Ajuda',
            'Misericórdia',
            'Areeiro',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($freguesias),
            'municipality_id' => Municipality::factory(),
        ];
    }
}
