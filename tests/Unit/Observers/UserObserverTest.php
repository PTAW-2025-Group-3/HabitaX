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

    public function test_advertisements_suspended_when_user_suspended()
    {
        $user = User::factory()->create();
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
            'property_id' => $property->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $user->update(['state' => 'suspended']);
        $ad->refresh();

        $this->assertTrue($ad->is_suspended);

        $user->update(['state' => 'active']);
        $ad->refresh();

        $this->assertFalse($ad->is_suspended);
    }
}
