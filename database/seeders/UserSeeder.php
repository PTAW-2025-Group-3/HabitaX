<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Kousha Rezaei',
                'email' => 'kosharezae@yahoo.com',
                'password' => 'passwordKousha',
                'user_type' => 'admin',
                'state' => 'active',
            ],
            [
                'name' => 'Sedro Pampaio',
                'email' => 'sedro@ua.pt',
                'password' => 'pampaio',
                'user_type' => 'moderator',
                'state' => 'active',
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'password3'
            ],
            [
                'name' => 'Sofia Dias',
                'email' => 'sofia@example.com',
                'password' => 'password4'
            ],
            [
                'name' => 'Rui Costa',
                'email' => 'rui@example.com',
                'password' => 'password5'
            ],
        ];

        foreach ($users as $user) {
            User::factory()
                ->create([
                    'email' => $user['email'],
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'user_type' => $user['user_type'] ?? 'user',
                    'state' => $user['state'] ?? 'active',
                ]
            );
        }
    }
}
