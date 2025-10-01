<?php

namespace Tests\Feature;

use App\Models\AdvertiserVerification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdvertiserVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_approved_advertiser_verification_sets_is_advertiser_to_true(): void
    {
        // Criar utilizador não anunciante
        $user = User::factory()->create([
            'is_advertiser' => false,
        ]);

        // Verificar que começa como não anunciante
        $this->assertFalse($user->is_advertiser);

        // Criar verificação
        $verification = AdvertiserVerification::create([
            'verification_advertiser_state' => 0,
            'submission_date' => now()->subDays(3),
            'validation_date' => now(),
            'document_url' => 'https://example.com/doc.pdf',
            'photo_url' => 'https://example.com/photo.jpg',
            'submitted_by' => $user->id,
            'validated_by' => $user->id,
            'submitted_at' => now()->subDays(3),
            'validated_at' => now(),
        ]);

        // Atualizar estado para aprovado (1)
        $verification->update([
            'verification_advertiser_state' => 1,
        ]);

        // Refrescar utilizador
        $user->refresh();

        // Verificar que foi atualizado para anunciante
        $this->assertNotNull($user->is_advertiser);
        $this->assertNotFalse($user->is_advertiser);
    }
}
