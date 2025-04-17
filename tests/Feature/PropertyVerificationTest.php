<?php

namespace Tests\Feature;

use App\Models\Parish;
use App\Models\Property;
use App\Models\PropertyVerification;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyVerificationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Garante que existem dados obrigatórios
        PropertyType::factory()->count(3)->create();
        Parish::factory()->count(3)->create();
    }

    public function test_approved_property_verification_sets_property_as_verified(): void
    {
        // Criar um utilizador
        $user = User::factory()->create();

        // Criar propriedade inicialmente não verificada
        $property = Property::factory()->create([
            'is_verified' => false,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        // Criar verificação com estado aprovado (approved)
        PropertyVerification::create([
            'property_id' => $property->id,
            'state' => 'approved',
            'documentation' => 'https://example.com/doc.pdf',
            'submission_date' => now()->subDays(3),
            'validation_date' => now(),
            'submitted_by' => $user->id,
            'validated_by' => $user->id,
        ]);

        // Refrescar a instância da propriedade
        $property->refresh();

        // Verificar se foi automaticamente marcada como verificada
        $this->assertTrue($property->is_verified);
    }
}
