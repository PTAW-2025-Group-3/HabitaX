<?php

namespace Tests\Unit\Models;

use App\Models\Advertisement;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Parish;
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

    public function test_advertisement_belongs_to_property()
    {
        $user = User::factory()->create();

        $property = Property::factory()->create([
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $ad = Advertisement::factory()->create([
            'property_id' => $property->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $this->assertEquals($property->id, $ad->property->id);
    }

    public function test_advertisement_fields_are_saved_correctly()
    {
        $user = User::factory()->create();

        $property = Property::factory()->create([
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $ad = Advertisement::factory()->create([
            'reference' => 789123,
            'title' => 'Test Apartment',
            'description' => 'Nice sea view',
            'transaction_type' => 'rent',
            'price' => 1200,
            'is_published' => true,
            'is_suspended' => false,
            'property_id' => $property->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $this->assertEquals('Test Apartment', $ad->title);
        $this->assertEquals('Nice sea view', $ad->description);
        $this->assertEquals('rent', $ad->transaction_type);
        $this->assertEquals(1200, $ad->price);
        $this->assertTrue($ad->is_published);
        $this->assertFalse($ad->is_suspended);
        $this->assertEquals($user->id, $ad->created_by);
    }
}
