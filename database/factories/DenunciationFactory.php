<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Advertisement;
use App\Models\DenunciationReason;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Denunciation>
 */
class DenunciationFactory extends Factory
{
    public function definition(): array
    {
        $creator = User::inRandomOrder()->first();
        $validator = User::inRandomOrder()->first();
        $advertisement = Advertisement::inRandomOrder()->first();
        $reason = DenunciationReason::inRandomOrder()->first();

        $state = 0;

        return [
            'advertisement_id' => $advertisement?->id,
            'reason_id' => $reason?->id,
            'desc' => $this->faker->sentence(),
            'report_state' => $state,
            'created_by' => $creator?->id,
            'validated_by' => $state === 0 ? null : $validator?->id,
            'submitted_at' => now()->subDays(rand(2, 15)),
            'validated_at' => $state === 0 ? null : now()->subDays(rand(0, 1)),
        ];
    }
}
