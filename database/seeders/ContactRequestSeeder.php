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
        // Verifica se existem utilizadores e anúncios
        $users = User::all();
        $ads = Advertisement::all();

        if ($users->isEmpty() || $ads->isEmpty()) {
            $this->command->warn('⚠️ É necessário ter utilizadores e anúncios antes de criar pedidos de contacto.');
            return;
        }

        // Criar 15 pedidos de contacto
        foreach (range(1, 15) as $i) {
            $user = $users->random();
            $ad = $ads->random();

            ContactRequest::create([
                'advertisement_id' => $ad->id,
                'created_by' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'telephone' => rand(910000000, 939999999),
                'message' => fake()->paragraph(3),
                'sentAt' => now()->subDays(rand(0, 10)),
                'state' => fake()->randomElement(['new', 'read', 'archived']),
            ]);
        }
    }
}
