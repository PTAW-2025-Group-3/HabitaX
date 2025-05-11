<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdvertiserVerification>
 */
class AdvertiserVerificationFactory extends Factory
{
    public function definition(): array
    {
        $submitter = User::inRandomOrder()->first();
        $validator = User::inRandomOrder()->first();

        $isValidated = $this->faker->boolean(70); // 70% das verificações estão validadas

        // Para verificações validadas, adicionar comentários do validador
        $validatorComments = null;
        if ($isValidated) {
            // Comentários apenas para algumas verificações (especialmente as rejeitadas)
            $hasComments = $this->faker->boolean(60); // 60% das verificações validadas têm comentários
            if ($hasComments) {
                $validatorComments = $this->faker->paragraph(2);
            }
        }

        return [
            'verification_advertiser_state' => $isValidated
                ? $this->faker->randomElement([1, 2]) // 1 = aprovado, 2 = rejeitado
                : 0, // 0 = pendente

            'submission_date' => now()->subDays(rand(2, 15)),
            'validation_date' => $isValidated ? now()->subDays(rand(0, 1)) : null,

            'identifier_type' => $this->faker->randomElement(['CC', 'Passaporte', 'Carta de Condução']),

            'submitted_by' => $submitter?->id,
            'validated_by' => $isValidated ? $validator?->id : null,

            'submitted_at' => now()->subDays(rand(2, 15)),
            'validated_at' => $isValidated ? now()->subDays(rand(0, 1)) : null,

            // Adicionar comentários do validador
            'validator_comments' => $validatorComments,
        ];
    }
}
