<?php

namespace Tests\Feature;

use App\Models\Advertisement;
use App\Models\Collection;
use App\Models\Parish;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CollectionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create required data for tests
        PropertyType::factory()->create();
        Parish::factory()->create();
    }

    protected function createProperty($user = null)
    {
        if (!$user) {
            $user = User::factory()->create();
        }

        $typeProperty = PropertyType::first();
        $parish = Parish::first();

        return Property::factory()->create([
            'property_type' => $typeProperty->id,
            'parish_id' => $parish->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);
    }

    public function test_collection_can_be_created_with_attributes(): void
    {
        $user = User::factory()->create();

        $collection = Collection::create([
            'name' => 'Favorites',
            'description' => 'My favorite properties',
            'is_public' => true,
            'created_by' => $user->id,
        ]);

        $this->assertDatabaseHas('collections', [
            'id' => $collection->id,
            'name' => 'Favorites',
            'description' => 'My favorite properties',
            'is_public' => true,
            'created_by' => $user->id,
        ]);

        // Verify relationship with creator
        $this->assertEquals($user->id, $collection->creator->id);
    }

    public function test_collection_can_have_advertisements_added(): void
    {
        $user = User::factory()->create();
        $property = $this->createProperty($user);

        $collection = Collection::create([
            'name' => 'Wishlist',
            'description' => 'Properties I want to buy',
            'is_public' => false,
            'created_by' => $user->id,
        ]);

        $advertisement1 = Advertisement::factory()->create([
            'property_id' => $property->id,
        ]);

        $advertisement2 = Advertisement::factory()->create([
            'property_id' => $property->id,
        ]);

        // Add advertisements to collection
        $collection->advertisements()->attach($advertisement1->id, ['addedAt' => now()]);
        $collection->advertisements()->attach($advertisement2->id, ['addedAt' => now()]);

        // Refresh the collection to get updated relationships
        $collection->refresh();

        // Check relationships
        $this->assertCount(2, $collection->advertisements);
        $this->assertTrue($collection->advertisements->contains($advertisement1));
        $this->assertTrue($collection->advertisements->contains($advertisement2));
    }

    public function test_collection_advertisement_pivot_data(): void
    {
        $user = User::factory()->create();
        $property = $this->createProperty($user);

        $advertisement = Advertisement::factory()->create([
            'property_id' => $property->id,
        ]);

        $collection = Collection::create([
            'name' => 'Investment Properties',
            'created_by' => $user->id,
        ]);

        $addedAt = now();
        $collection->advertisements()->attach($advertisement->id, ['addedAt' => $addedAt]);

        // Get the pivot data
        $pivot = $collection->advertisements()->first()->pivot;

        // Check pivot fields
        $this->assertEquals($collection->id, $pivot->collection_id);
        $this->assertEquals($advertisement->id, $pivot->advertisement_id);

        // Assert that addedAt exists and is a valid date, without comparing exact seconds
        $this->assertNotNull($pivot->addedAt);

        // Get formatted date string from pivot->addedAt regardless of whether it's a string or Carbon instance
        $pivotDate = is_string($pivot->addedAt)
            ? \Carbon\Carbon::parse($pivot->addedAt)->format('Y-m-d H:i:s')
            : $pivot->addedAt->format('Y-m-d H:i:s');

        // Check that the dates match when truncated to the same precision
        $this->assertStringStartsWith(
            substr($addedAt->format('Y-m-d H:i'), 0, 16),
            substr($pivotDate, 0, 16)
        );
    }

    public function test_delete_collection_removes_pivot_entries(): void
    {
        $user = User::factory()->create();
        $property = $this->createProperty($user);

        $advertisement = Advertisement::factory()->create([
            'property_id' => $property->id,
        ]);

        $collection = Collection::create([
            'name' => 'Test Collection',
            'created_by' => $user->id,
        ]);

        $collection->advertisements()->attach($advertisement->id, ['addedAt' => now()]);

        // Verify pivot entry exists
        $this->assertDatabaseHas('advertisement_collection', [
            'collection_id' => $collection->id,
            'advertisement_id' => $advertisement->id,
        ]);

        // Delete collection
        $collection->delete();

        // Verify pivot entry is removed
        $this->assertDatabaseMissing('advertisement_collection', [
            'collection_id' => $collection->id,
            'advertisement_id' => $advertisement->id,
        ]);

        // Verify advertisement still exists
        $this->assertDatabaseHas('advertisements', ['id' => $advertisement->id]);
    }

    public function test_delete_advertisement_removes_pivot_entries(): void
    {
        $user = User::factory()->create();
        $property = $this->createProperty($user);

        $advertisement = Advertisement::factory()->create([
            'property_id' => $property->id,
        ]);

        $collection = Collection::create([
            'name' => 'Test Collection',
            'created_by' => $user->id,
        ]);

        $collection->advertisements()->attach($advertisement->id, ['addedAt' => now()]);

        // Verify pivot entry exists
        $this->assertDatabaseHas('advertisement_collection', [
            'collection_id' => $collection->id,
            'advertisement_id' => $advertisement->id,
        ]);

        // Delete advertisement
        $advertisement->delete();

        // Verify pivot entry is removed
        $this->assertDatabaseMissing('advertisement_collection', [
            'collection_id' => $collection->id,
            'advertisement_id' => $advertisement->id,
        ]);

        // Verify collection still exists
        $this->assertDatabaseHas('collections', ['id' => $collection->id]);
    }
}
