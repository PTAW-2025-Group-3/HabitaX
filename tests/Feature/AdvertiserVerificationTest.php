<?php

namespace Tests\Feature;

use App\Models\AdvertiserVerification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdvertiserVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_approved_advertiser_verification_sets_advertiser_number(): void
    {
        // Criar utilizador sem advertiserNumber
        $user = User::factory()->create([
            'advertiser_number' => null,
        ]);

        // Verificar que começa sem advertiserNumber
        $this->assertNull($user->advertiserNumber);

        // Criar verificação aprovada (1 = approved)
        AdvertiserVerification::create([
            'verification_advertiser_state' => 1,
            'submission_date' => now()->subDays(3),
            'validation_date' => now(),
            'document_url' => 'https://example.com/doc.pdf',
            'photo_url' => 'https://example.com/photo.jpg',
            'submitted_by' => $user->id,
            'validated_by' => $user->id,
            'submitted_at' => now()->subDays(3),
            'validated_at' => now(),
        ]);

        // Refrescar utilizador
        $user->refresh();

        // Verificar que recebeu advertiserNumber
        $this->assertNotNull($user->advertiserNumber);
        $this->assertIsInt($user->advertiserNumber);
    }
}
