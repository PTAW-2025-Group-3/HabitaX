<?php

namespace Tests\Feature;

use App\Models\Advertisement;
use App\Models\Denunciation;
use App\Models\DenunciationReason;
use App\Models\Property;
use App\Models\TypeProperty;
use App\Models\Parish;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DenunciationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Criar dados obrigatórios
        TypeProperty::factory()->create();
        Parish::factory()->create();
    }

    public function test_denunciation_is_created_and_linked_correctly(): void
    {
        $user = User::factory()->create();

        $property = Property::factory()->create([
            'is_verified' => true,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $advertisement = Advertisement::factory()->create([
            'property_id' => $property->id,
        ]);

        $reason = \App\Models\DenunciationReason::factory()->create([
            'name' => 'Informação falsa',
        ]);

        $denunciation = Denunciation::create([
            'advertisement_id' => $advertisement->id,
            'reason_id' => $reason->id,
            'created_by' => $user->id,
            'report_state' => 0, // pending
            'desc' => 'Denúncia de teste',
            'submitted_at' => now(),
            'validated_by' => null,
            'validated_at' => null,
        ]);

        // Verificações
        $this->assertDatabaseHas('denunciations', [
            'id' => $denunciation->id,
            'advertisement_id' => $advertisement->id,
            'reason_id' => $reason->id,
            'created_by' => $user->id,
            'report_state' => 0,
        ]);


        $this->assertEquals($user->id, $denunciation->created_by);
        $this->assertEquals($advertisement->id, $denunciation->advertisement_id);
        $this->assertEquals($reason->id, $denunciation->reason_id);

    }
}
