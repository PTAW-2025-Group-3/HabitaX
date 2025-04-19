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
                'userType' => 'admin'
            ],
            [
                'name' => 'Sara Moshiri',
                'email' => 'sara@example.com',
                'password' => 'password2'
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
            User::updateOrCreate(
                ['email' => $user['email']], // Prevent duplicate seed
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'telephone' => rand(910000000, 939999999),
                    'profilePhoto_url' => 'https://via.placeholder.com/150',
                    'userType' => $user['userType'] ?? 'user',
                    'advertiserNumber' => rand(10000, 99999),
                    'staffNumber' => rand(10000, 99999),
                    'bio' => 'Sou um utilizador ativo da plataforma.',
                    'email_notifications' => true,
                    'message_notifications' => true,
                    'public_profile' => true,
                    'show_email' => false,
                ]
            );
        }
    }
}
