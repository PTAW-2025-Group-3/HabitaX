<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PropertyTypeSeeder::class);
        $this->call(UserSeeder::class);

        $this->call([
            DistrictSeeder::class,
            MunicipalitySeeder::class,
            ParishSeeder::class,
        ]);

        $this->call(PropertySeeder::class);
        $this->call(AdvertisementSeeder::class);
        $this->call(ContactRequestSeeder::class);
        $this->call(CollectionSeeder::class);
        $this->call(AdvertisementCollectionSeeder::class);
        $this->call(AdvertiserVerificationSeeder::class);
        $this->call(DenunciationReasonSeeder::class);
        $this->call(DenunciationSeeder::class);
        $this->call(PriceHistorySeeder::class);
        $this->call(PropertyVerificationSeeder::class);
        $this->call(PropertyAttributeSeeder::class);
        $this->call(PropertyTypeAttributeSeeder::class);
        $this->call(PropertyValueSeeder::class);

    }
}
