<?php

namespace Tests\Unit\Observers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Advertisement;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdvertisementObserverTest extends TestCase
{
    use RefreshDatabase;

    public function test_price_history_record_created_on_advertisement_create()
    {
        $user = User::factory()->create();
        $propertyType = PropertyType::factory()->create();

        $property = Property::factory()->create([
            'property_type_id' => $propertyType->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $ad = Advertisement::factory()->create([
            'price' => 100000,
            'property_id' => $property->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $this->assertDatabaseHas('price_histories', [
            'advertisement_id' => $ad->id,
            'price' => 100000,
        ]);
    }

    public function test_price_history_record_created_on_price_update()
    {
        $user = User::factory()->create();
        $propertyType = PropertyType::factory()->create();

        $property = Property::factory()->create([
            'property_type_id' => $propertyType->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $ad = Advertisement::factory()->create([
            'price' => 100000,
            'property_id' => $property->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $ad->update(['price' => 120000]);

        $this->assertDatabaseHas('price_histories', [
            'advertisement_id' => $ad->id,
            'price' => 100000,
        ]);

        $this->assertDatabaseHas('price_histories', [
            'advertisement_id' => $ad->id,
            'price' => 120000,
        ]);
    }
}
