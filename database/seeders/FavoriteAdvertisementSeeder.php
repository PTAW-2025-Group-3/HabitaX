<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteAdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 favorite advertisements for each user
        $users = \App\Models\User::all();
        $advertisements = \App\Models\Advertisement::all();

        foreach ($users as $user) {
            foreach ($advertisements->random(2) as $ad) {
                \App\Models\FavoriteAdvertisement::create([
                    'user_id' => $user->id,
                    'advertisement_id' => $ad->id,
                ]);
            }
        }
    }
}
