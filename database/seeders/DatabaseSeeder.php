<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        if (\App\Models\User::class::count() === 0) {
            $this->call([
                UserSeeder::class,
                DistrictSeeder::class,
                MunicipalitySeeder::class,
                ParishSeeder::class,
                PropertyTypeSeeder::class,
                PropertyAttributeGroupSeeder::class,
                PropertyAttributeSeeder::class,
                PropertyAttributeGroupAttributeSeeder::class,
                PropertyTypeAttributeSeeder::class
            ]);
        }
        $this->call(PropertySeeder::class);
        $this->call(PropertyVerificationSeeder::class);
        $this->call(PropertyParameterSeeder::class);
        $this->call(AdvertisementSeeder::class);
        $this->call(PriceHistorySeeder::class);
        $this->call(AdvertiserVerificationSeeder::class);
        $this->call(FavoriteAdvertisementSeeder::class);
        $this->call(ContactRequestSeeder::class);
        $this->call(DenunciationReasonSeeder::class);
        $this->call(DenunciationSeeder::class);
    }
}
