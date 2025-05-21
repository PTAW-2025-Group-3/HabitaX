<?php

namespace Tests\Unit\Models;

use App\Models\Property;
use App\Models\User;
use App\Models\Parish;
use App\Models\PropertyType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use RefreshDatabase;

    protected PropertyType $propertyType;
    protected Parish $parish;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->propertyType = PropertyType::factory()->create();
        $this->parish = Parish::factory()->create();
        $this->user = User::factory()->create();
    }

    public function test_property_belongs_to_creator(): void
    {
        $property = Property::factory()->create([
            'created_by' => $this->user->id,
            'updated_by' => $this->user->id,
            'property_type_id' => $this->propertyType->id,
            'parish_id' => $this->parish->id,
        ]);

        $this->assertNotNull($property->creator);
        $this->assertEquals($this->user->id, $property->creator->id);
    }

    public function test_property_fields_are_stored_correctly(): void
    {
        $property = Property::factory()->create([
            'is_active' => true,
            'is_verified' => true,
            'created_by' => $this->user->id,
            'updated_by' => $this->user->id,
            'property_type_id' => $this->propertyType->id,
            'parish_id' => $this->parish->id,
        ]);

        $this->assertDatabaseHas('properties', [
            'id' => $property->id,
            'is_active' => true,
            'is_verified' => true,
        ]);
    }

    public function test_property_relationships_are_set(): void
    {
        $property = Property::factory()->create([
            'created_by' => $this->user->id,
            'updated_by' => $this->user->id,
            'property_type_id' => $this->propertyType->id,
            'parish_id' => $this->parish->id,
        ]);

        $this->assertNotNull($property->property_type);
        $this->assertNotNull($property->parish);
    }
}
