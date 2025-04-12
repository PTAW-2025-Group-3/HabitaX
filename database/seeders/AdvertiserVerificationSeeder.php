<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdvertiserVerification;
use App\Models\User;

class AdvertiserVerificationSeeder extends Seeder
{
    public function run(): void
    {
        if (User::count() === 0) {
            $this->command->warn('Nenhum utilizador encontrado. Corre o UserSeeder primeiro.');
            return;
        }

        // Cria 15 verificações de anunciantes
        AdvertiserVerification::factory()->count(15)->create();
    }
}
