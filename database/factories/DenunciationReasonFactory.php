<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DenunciationReason>
 */
class DenunciationReasonFactory extends Factory
{
    public function definition(): array
    {
        $reasons = [
            'Conteúdo enganoso ou falso',
            'Spam ou publicidade não solicitada',
            'Informação ofensiva ou abusiva',
            'Fraude ou tentativa de burla',
            'Violação de direitos de autor',
            'Informações pessoais expostas',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($reasons),
            'is_active' => $this->faker->boolean(90), // maior probabilidade de estar ativo
        ];
    }
}
