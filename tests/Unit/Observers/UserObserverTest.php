<?php

namespace Tests\Unit\Observers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Advertisement;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserObserverTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_state_changed_to_suspended_deactivates_properties_and_ads()
    {
        $user = User::factory()->create(['state' => 'active']);
        $propertyType = PropertyType::factory()->create();

        $property = Property::factory()->create([
            'user_id' => $user->id,
            'property_type_id' => $propertyType->id,
            'is_active' => true,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $ad = Advertisement::factory()->create([
            'user_id' => $user->id,
            'is_suspended' => false,
            'property_id' => $property->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $user->update(['state' => 'suspended']);

        $this->assertFalse($user->fresh()->properties()->first()->is_active);
        $this->assertTrue($user->fresh()->advertisements()->first()->is_suspended);
    }

    public function test_user_state_changed_from_suspended_to_active_reactivates_properties_only()
    {
        $user = User::factory()->create(['state' => 'suspended']);
        $propertyType = PropertyType::factory()->create();

        $property = Property::factory()->create([
            'user_id' => $user->id,
            'property_type_id' => $propertyType->id,
            'is_active' => false,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $ad = Advertisement::factory()->create([
            'user_id' => $user->id,
            'is_suspended' => true,
            'property_id' => $property->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $user->update(['state' => 'active']);

        $this->assertTrue($user->fresh()->properties()->first()->is_active);
        $this->assertTrue($user->fresh()->advertisements()->first()->is_suspended); // stays suspended
    }
}
