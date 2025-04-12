<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collection;
use App\Models\User;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('Nenhum utilizador encontrado. Corre o UserSeeder primeiro.');
            return;
        }

        // Cria 10 coleções associadas a users existentes
        foreach (range(1, 10) as $i) {
            $user = $users->random();

            Collection::create([
                'name' => fake()->words(2, true), // Ex: "Favoritos Braga"
                'description' => fake()->optional()->paragraph(),
                'is_public' => fake()->boolean(30),
                'created_by' => $user->id,
            ]);
        }
    }
}
