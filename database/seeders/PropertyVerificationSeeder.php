<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\User;
use App\Models\PropertyVerification;

class PropertyVerificationSeeder extends Seeder
{
    public function run(): void
    {
        if (
            User::count() === 0 ||
            Property::count() === 0
        ) {
            $this->command->warn('É necessário ter utilizadores e propriedades para criar verificações.');
            return;
        }

        PropertyVerification::factory()->count(15)->create();
    }
}
