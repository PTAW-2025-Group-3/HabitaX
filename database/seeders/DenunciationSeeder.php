<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Denunciation;
use App\Models\User;
use App\Models\Advertisement;
use App\Models\DenunciationReason;

class DenunciationSeeder extends Seeder
{
    public function run(): void
    {
        if (
            User::count() === 0 ||
            Advertisement::count() === 0 ||
            DenunciationReason::count() === 0
        ) {
            $this->command->warn('É necessário ter utilizadores, anúncios e motivos de denúncia antes de criar denúncias.');
            return;
        }

        Denunciation::factory()->count(15)->create();
    }
}
