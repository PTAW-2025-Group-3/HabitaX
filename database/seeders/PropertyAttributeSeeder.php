<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyAttribute;

class PropertyAttributeSeeder extends Seeder
{
    public function run(): void
    {
        PropertyAttribute::factory()->count(10)->create([
            'is_active' => true,
            'is_required' => false,
        ]);

        PropertyAttribute::factory()->count(5)->create([
            'is_active' => true,
            'is_required' => true,
        ]);
    }
}
