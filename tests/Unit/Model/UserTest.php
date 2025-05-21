<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Property;
use App\Models\Advertisement;
use App\Models\PropertyType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_properties_relationship()
    {
        $user = User::factory()->create();
        $propertyType = PropertyType::factory()->create();

        $property = Property::factory()->create([
            'user_id' => $user->id,
            'property_type_id' => $propertyType->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $this->assertTrue($user->properties->contains($property));
    }

    public function test_user_has_advertisements_relationship()
    {
        $user = User::factory()->create();
        $propertyType = PropertyType::factory()->create();

        $property = Property::factory()->create([
            'user_id' => $user->id,
            'property_type_id' => $propertyType->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $ad = Advertisement::factory()->create([
            'user_id' => $user->id,
            'property_id' => $property->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $this->assertTrue($user->advertisements->contains($ad));
    }

    public function test_user_fillable_fields_work_as_expected()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ];

        $user = User::create($data);

        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
    }
}
