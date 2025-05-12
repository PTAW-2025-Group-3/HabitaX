<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdvertiserVerification;
use App\Models\User;
use Illuminate\Support\Facades\File;

class AdvertiserVerificationSeeder extends Seeder
{
    public function run(): void
    {
        if (User::count() === 0) {
            $this->command->warn('Nenhum utilizador encontrado. Corre o UserSeeder primeiro.');
            return;
        }

        // Caminho para as imagens de exemplo para documentos
        $imageFolder = storage_path('document-seed-images');
        $extensions = ['jpg', 'jpeg', 'png', 'webp'];
        $imageFiles = [];

        // Verificar se a pasta existe e criar se necessário
        if (!File::exists($imageFolder)) {
            File::makeDirectory($imageFolder, 0755, true);
            $this->command->warn("Pasta {$imageFolder} criada. Adicione algumas imagens de exemplo antes de continuar.");
            return;
        }

        foreach ($extensions as $ext) {
            $imageFiles = array_merge($imageFiles, glob("{$imageFolder}/*.{$ext}"));
        }

        if (count($imageFiles) < 3) {
            $this->command->warn("Não há imagens suficientes em {$imageFolder}. Serão criadas verificações sem imagens.");
        }

        // Cria 15 verificações de anunciantes com comentários
        AdvertiserVerification::factory()->count(15)->create()->each(function ($verification) use ($imageFiles, $extensions) {
            // Para verificações rejeitadas, garantir que tenham comentários do validador
            if ($verification->verification_advertiser_state === 2 && empty($verification->validator_comments)) {
                $verification->validator_comments = fake()->sentence(10);
                $verification->save();
            }

            if (count($imageFiles) >= 3) {
                // Adiciona até 3 imagens aleatórias (frente, verso e selfie)
                $randomFiles = collect($imageFiles)->random(rand(1, 3));

                // Adiciona cada imagem à coleção 'documents'
                foreach ($randomFiles as $path) {
                    $verification->addMedia($path)
                        ->preservingOriginal()
                        ->withCustomProperties([
                            'description' => fake()->randomElement([
                                'Documento - Frente',
                                'Documento - Verso',
                                'Selfie com Documento'
                            ])
                        ])
                        ->toMediaCollection('documents');
                }
            }
        });

        // Atualize as verificações aprovadas para ter número de anunciante
        AdvertiserVerification::where('verification_advertiser_state', 1)
            ->get()
            ->each(function ($verification) {
                if ($verification->submitter && !$verification->submitter->is_advertiser) {
                    $verification->submitter->update([
                        'is_advertiser' => true,
                    ]);
                }
            });

        $this->command->info('AdvertiserVerificationSeeder: Verificações de anunciantes criadas com sucesso.');
    }
}
