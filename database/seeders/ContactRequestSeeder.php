<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactRequest;
use App\Models\User;
use App\Models\Advertisement;

class ContactRequestSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $ads = Advertisement::all();

        if ($ads->isEmpty()) {
            $this->command->warn('⚠️ É necessário ter anúncios antes de criar pedidos de contacto.');
            return;
        }

        ContactRequest::factory()->count(20)->create();
    }
}

