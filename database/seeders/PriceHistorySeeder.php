<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PriceHistory;
use App\Models\Advertisement;
use Carbon\Carbon;

class PriceHistorySeeder extends Seeder
{
    public function run(): void
    {
        $ads = Advertisement::all();

        if ($ads->isEmpty()) {
            $this->command->warn('⚠️ Nenhum anúncio encontrado. Corre os seeders de anúncios primeiro.');
            return;
        }

        foreach ($ads as $ad) {
            $numRegistos = rand(1, 5);
            $startPrice = rand(50000, 400000);
            $date = Carbon::now()->subDays($numRegistos * 10);

            for ($i = 0; $i < $numRegistos; $i++) {
                PriceHistory::create([
                    'advertisement_id' => $ad->id,
                    'price' => $startPrice + rand(-5000, 10000),
                    'register_date' => $date->copy()->addDays($i * 10),
                ]);
            }
        }
    }
}
