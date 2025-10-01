<?php

namespace Tests\Feature;

use App\Models\Advertisement;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Parish;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdvertisementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        PropertyType::factory()->create();
        Parish::factory()->create();
    }

    public function test_advertisement_is_created_and_linked_correctly(): void
    {
        $user = User::factory()->create();

        $property = Property::factory()->create([
            'is_verified' => true,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $advertisement = Advertisement::create([
            'reference' => 123456,
            'title' => 'Apartamento Teste',
            'description' => 'Apartamento com vista para o mar',
            'transaction_type' => 'rent',
            'price' => 850.00,
            'state' => 'active',
            'property_id' => $property->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $this->assertDatabaseHas('advertisements', [
            'id' => $advertisement->id,
            'reference' => 123456,
            'transaction_type' => 'rent',
            'property_id' => $property->id,
        ]);

        $this->assertEquals('Apartamento com vista para o mar', $advertisement->description);
        $this->assertEquals(850.00, $advertisement->price);
        $this->assertEquals($property->id, $advertisement->property_id);

        $this->assertEquals($property->id, $advertisement->property->id);
    }
}
