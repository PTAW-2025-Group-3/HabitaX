<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PropertyAttributeGroupAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = \App\Models\PropertyAttributeGroup::all();
        $attributes = \App\Models\PropertyAttribute::all();
        $groupAttributes = [];
        foreach ($groups as $group) {
            $groupAttributes = $attributes->random(rand(3, 10))->pluck('id')->toArray();
            foreach ($groupAttributes as $attributeId) {
                \App\Models\PropertyAttributeGroupAttribute::create([
                    'group_id' => $group->id,
                    'attribute_id' => $attributeId,
                ]);
            }
        }
    }
}
