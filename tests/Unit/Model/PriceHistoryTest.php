<?php

namespace Tests\Unit\Models;

use App\Models\Advertisement;
use App\Models\Parish;
use App\Models\PriceHistory;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PriceHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_price_history_belongs_to_advertisement(): void
    {
        $user = User::factory()->create();
        $type = PropertyType::factory()->create();
        $parish = Parish::factory()->create();

        $property = Property::factory()->create([
            'property_type_id' => $type->id,
            'parish_id' => $parish->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $advertisement = Advertisement::factory()->create([
            'property_id' => $property->id,
            'user_id' => $user->id,
        ]);

        $history = PriceHistory::create([
            'advertisement_id' => $advertisement->id,
            'price' => 123000,
            'register_date' => now(),
        ]);

        $this->assertNotNull($history->advertisement);
        $this->assertEquals($advertisement->id, $history->advertisement->id);
    }

    public function test_price_history_fields_are_cast_correctly(): void
    {
        $user = User::factory()->create();
        $type = PropertyType::factory()->create();
        $parish = Parish::factory()->create();

        $property = Property::factory()->create([
            'property_type_id' => $type->id,
            'parish_id' => $parish->id,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $advertisement = Advertisement::factory()->create([
            'property_id' => $property->id,
            'user_id' => $user->id,
        ]);

        $now = now();

        $history = PriceHistory::create([
            'advertisement_id' => $advertisement->id,
            'price' => 500000.75,
            'register_date' => $now,
        ]);

        $this->assertIsFloat($history->price);
        $this->assertEquals(500000.75, $history->price);
        $this->assertEquals($now->format('Y-m-d H:i'), $history->register_date->format('Y-m-d H:i'));
    }
}
