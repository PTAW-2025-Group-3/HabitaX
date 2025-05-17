<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
            $user = User::factory()
                ->create([
                    'email' => $user['email'],
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'user_type' => $user['user_type'] ?? 'user',
                    'state' => $user['state'] ?? 'active',
                ]
            );
            $this->attachProfilePicture($user);
        }
    }

    private function attachProfilePicture(User $user): void
    {
        $picturesPath = 'profile_pictures/';
        $pictures = Storage::disk('public')->files($picturesPath);
        if (count($pictures) > 20) {
            // Select a random picture from the existing ones
            $fileName = $pictures[array_rand($pictures)];
        } else {
            // Fetch a new picture from the URL
            $seed = fake()->uuid;
            $fileName = $picturesPath . 'picture_' . $seed . '.jpeg';
            $url = "https://picsum.photos/200/200?random={$seed}";

            $response = Http::get($url);

            if ($response->ok()) {
                Storage::disk('public')->put($fileName, $response->body());
            }
        }

        $user->addMedia(storage_path('app/public/' . $fileName))
            ->preservingOriginal()
            ->toMediaCollection('picture');
    }
}
