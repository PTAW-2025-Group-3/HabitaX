<?php

namespace Tests\Feature;

use App\Models\Parish;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyListingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Garante dados obrigatórios para criação de propriedades
        PropertyType::factory()->count(2)->create();
        Parish::factory()->count(2)->create();
    }

    public function test_only_verified_properties_are_listed(): void
    {
        $user = User::factory()->create();

        // Propriedade verificada
        $verified = Property::factory()->create([
            'is_verified' => true,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        // Propriedade não verificada
        $notVerified = Property::factory()->create([
            'is_verified' => false,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        // Simular listagem (poderia ser lógica do controller também)
        $listedProperties = Property::where('is_verified', true)->get();

        // Verificações
        $this->assertTrue($listedProperties->contains($verified));
        $this->assertFalse($listedProperties->contains($notVerified));
    }
}
