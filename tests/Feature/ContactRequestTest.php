<?php

namespace Tests\Feature;

use App\Models\Advertisement;
use App\Models\ContactRequest;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Parish;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactRequestTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Criar dados obrigatórios
        PropertyType::factory()->create();
        Parish::factory()->create();
    }

    public function test_contact_request_is_created_and_linked_correctly(): void
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

        $contactRequest = ContactRequest::create([
            'advertisement_id' => $advertisement->id,
            'created_by' => $user->id,
            'name' => 'João Silva',
            'email' => 'joao.silva@example.com',
            'telephone' => '912345678',
            'message' => 'Estou interessado neste imóvel. Quando posso visitar?',
            'state' => 'new',
        ]);

        // Verificações
        $this->assertDatabaseHas('contact_requests', [
            'id' => $contactRequest->id,
            'advertisement_id' => $advertisement->id,
            'created_by' => $user->id,
            'name' => 'João Silva',
            'email' => 'joao.silva@example.com',
            'state' => 'new',
        ]);

        $this->assertEquals('Estou interessado neste imóvel. Quando posso visitar?', $contactRequest->message);
        $this->assertEquals('912345678', $contactRequest->telephone);

        // Verificar relações
        $this->assertEquals($user->id, $contactRequest->creator->id);
        $this->assertEquals($advertisement->id, $contactRequest->advertisement->id);
    }

    public function test_contact_request_state_transitions(): void
    {
        $user = User::factory()->create();

        // First create a property
        $property = Property::factory()->create([
            'is_verified' => true,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        // Then provide the property_id to the advertisement
        $advertisement = Advertisement::factory()->create([
            'property_id' => $property->id,
        ]);

        $contactRequest = ContactRequest::factory()->create([
            'advertisement_id' => $advertisement->id,
            'created_by' => $user->id,
            'state' => 'new',
        ]);

        // Verifica estado inicial
        $this->assertEquals('new', $contactRequest->state);

        // Atualiza para lido
        $contactRequest->state = 'read';
        $contactRequest->save();
        $this->assertEquals('read', $contactRequest->fresh()->state);

        // Atualiza para arquivado
        $contactRequest->state = 'archived';
        $contactRequest->save();
        $this->assertEquals('archived', $contactRequest->fresh()->state);
    }

    public function test_contact_request_is_linked_to_correct_advertisement(): void
    {
        $user = User::factory()->create();

        // Create properties first
        $property1 = Property::factory()->create([
            'is_verified' => true,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $property2 = Property::factory()->create([
            'is_verified' => true,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        // Create advertisements with property_id
        $advertisement1 = Advertisement::factory()->create([
            'property_id' => $property1->id,
        ]);
        $advertisement2 = Advertisement::factory()->create([
            'property_id' => $property2->id,
        ]);

        $contactRequest = ContactRequest::factory()->create([
            'advertisement_id' => $advertisement1->id,
            'created_by' => $user->id,
        ]);

        // Verifica se está associado ao anúncio correto
        $this->assertEquals($advertisement1->id, $contactRequest->advertisement_id);
        $this->assertNotEquals($advertisement2->id, $contactRequest->advertisement_id);

        // Verifica a relação
        $this->assertInstanceOf(Advertisement::class, $contactRequest->advertisement);
        $this->assertEquals($advertisement1->id, $contactRequest->advertisement->id);
    }
}
