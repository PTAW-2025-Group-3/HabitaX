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

        return [
            'verification_annunciant_state' => $isValidated
                ? $this->faker->randomElement([1, 2]) // 1 = aprovado, 2 = rejeitado
                : 0, // 0 = pendente

            'submissionDate' => now()->subDays(rand(2, 15)),
            'validationDate' => $isValidated ? now()->subDays(rand(0, 1)) : null,

            'document_url' => $this->faker->url(),
            'photo_url' => $this->faker->imageUrl(400, 400, 'people'),

            'submittedBy' => $submitter?->id,
            'validatedBy' => $isValidated ? $validator?->id : null,

            'submittedAt' => now()->subDays(rand(2, 15)),
            'validatedAt' => $isValidated ? now()->subDays(rand(0, 1)) : null,
        ];
    }
}
