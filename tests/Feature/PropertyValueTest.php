<?php

namespace Tests\Feature;

use App\Models\Parish;
use App\Models\Property;
use App\Models\PropertyAttribute;
use App\Models\PropertyAttributeType;
use App\Models\PropertyValue;
use App\Models\TypeProperty;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyValueTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Parish::factory()->create(); // Necessário para propriedade
    }

    public function test_property_values_are_created_only_for_attributes_linked_to_type(): void
    {
        $user = User::factory()->create();

        // Criar tipo de propriedade
        $type = TypeProperty::factory()->create();

        // Criar atributos
        $attributes = PropertyAttribute::factory()->count(3)->create([
            'type' => 'text',
        ]);

        // Ligar atributos ao tipo usando PropertyAttributeType
        foreach ($attributes as $attribute) {
            PropertyAttributeType::create([
                'property_type' => $type->id,
                'attribute_id' => $attribute->id,
                'required' => true,
            ]);
        }

        // Criar um atributo que NÃO está ligado a este tipo
        $unrelatedAttribute = PropertyAttribute::factory()->create(['type' => 'text']);

        // Criar propriedade com este tipo
        $property = Property::factory()->create([
            'type_property' => $type->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        // Criar valores APENAS para os atributos ligados ao tipo
        foreach ($attributes as $attribute) {
            PropertyValue::create([
                'property_id' => $property->id,
                'attribute_id' => $attribute->id,
                'value' => 'Valor de teste',
            ]);
        }

        // Verificações
        $this->assertCount(3, $property->values); // só os ligados ao tipo
        $this->assertDatabaseMissing('property_values', [
            'attribute_id' => $unrelatedAttribute->id,
            'property_id' => $property->id,
        ]);
    }
}
