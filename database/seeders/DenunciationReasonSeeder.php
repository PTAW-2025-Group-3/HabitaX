<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DenunciationReason;

class DenunciationReasonSeeder extends Seeder
{
    public function run(): void
    {
        $reasons = [
            'Conteúdo enganoso ou falso',
            'Spam ou publicidade não solicitada',
            'Informação ofensiva ou abusiva',
            'Fraude ou tentativa de burla',
            'Violação de direitos de autor',
            'Informações pessoais expostas',
        ];

        foreach ($reasons as $reason) {
            DenunciationReason::firstOrCreate(
                ['name' => $reason],
                ['is_active' => true]
            );
        }
    }
}
