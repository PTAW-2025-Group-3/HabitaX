<?php

namespace Tests\Feature;

use App\Models\District;
use App\Models\Municipality;
use App\Models\Parish;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GeoHierarchyRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_district_municipality_parish_relationship_hierarchy(): void
    {
        // Create a district
        $district = District::create([
            'name' => 'Lisboa'
        ]);

        // Create municipalities within the district
        $municipality1 = Municipality::create([
            'name' => 'Lisboa',
            'district_id' => $district->id
        ]);

        $municipality2 = Municipality::create([
            'name' => 'Sintra',
            'district_id' => $district->id
        ]);

        // Create parishes within municipalities
        $parish1 = Parish::create([
            'name' => 'Benfica',
            'municipality_id' => $municipality1->id
        ]);

        $parish2 = Parish::create([
            'name' => 'Arroios',
            'municipality_id' => $municipality1->id
        ]);

        $parish3 = Parish::create([
            'name' => 'Algueirão-Mem Martins',
            'municipality_id' => $municipality2->id
        ]);

        // Test District -> Municipality relationship
        $this->assertCount(2, $district->municipalities);
        $this->assertEquals('Lisboa', $district->municipalities->first()->name);
        $this->assertEquals('Sintra', $district->municipalities->last()->name);

        // Test Municipality -> Parish relationship
        $this->assertCount(2, $municipality1->parishes);
        $this->assertCount(1, $municipality2->parishes);
        $this->assertEquals('Benfica', $municipality1->parishes->first()->name);
        $this->assertEquals('Algueirão-Mem Martins', $municipality2->parishes->first()->name);

        // Test Parish -> Municipality -> District relationship (upwards)
        $this->assertEquals('Lisboa', $parish1->municipality->name);
        $this->assertEquals('Lisboa', $parish1->municipality->district->name);
        $this->assertEquals('Sintra', $parish3->municipality->name);
        $this->assertEquals('Lisboa', $parish3->municipality->district->name);
    }

    public function test_cascading_deletes(): void
    {
        // Create hierarchy
        $district = District::create(['name' => 'Porto']);

        $municipality = Municipality::create([
            'name' => 'Porto',
            'district_id' => $district->id
        ]);

        $parish = Parish::create([
            'name' => 'Cedofeita',
            'municipality_id' => $municipality->id
        ]);

        // Verify data exists
        $this->assertDatabaseHas('districts', ['name' => 'Porto']);
        $this->assertDatabaseHas('municipalities', ['name' => 'Porto']);
        $this->assertDatabaseHas('parishes', ['name' => 'Cedofeita']);

        // Test cascade delete from District
        $district->delete();

        // Verify all related records are deleted
        $this->assertDatabaseMissing('districts', ['name' => 'Porto']);
        $this->assertDatabaseMissing('municipalities', ['name' => 'Porto']);
        $this->assertDatabaseMissing('parishes', ['name' => 'Cedofeita']);
    }

    public function test_municipality_cascade_delete_preserves_other_parishes(): void
    {
        // Create test data
        $district = District::create(['name' => 'Faro']);

        $municipality1 = Municipality::create([
            'name' => 'Faro',
            'district_id' => $district->id
        ]);

        $municipality2 = Municipality::create([
            'name' => 'Albufeira',
            'district_id' => $district->id
        ]);

        $parish1 = Parish::create([
            'name' => 'Sé',
            'municipality_id' => $municipality1->id
        ]);

        $parish2 = Parish::create([
            'name' => 'Albufeira',
            'municipality_id' => $municipality2->id
        ]);

        // Delete one municipality
        $municipality1->delete();

        // Verify correct deletion
        $this->assertDatabaseMissing('municipalities', ['name' => 'Faro']);
        $this->assertDatabaseMissing('parishes', ['name' => 'Sé']);

        // Verify other data remains
        $this->assertDatabaseHas('districts', ['name' => 'Faro']);
        $this->assertDatabaseHas('municipalities', ['name' => 'Albufeira']);
        $this->assertDatabaseHas('parishes', ['name' => 'Albufeira']);
    }
}
