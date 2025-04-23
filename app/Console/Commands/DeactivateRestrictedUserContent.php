<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeactivateRestrictedUserContent extends Command
{
    protected $signature = 'users:deactivate-content';
    protected $description = 'Deactivate content from users with restricted states';

    public function handle()
    {
        $restrictedStates = ['suspended', 'banned', 'archived'];
        $users = User::whereIn('state', $restrictedStates)->get();

        $this->info("Processing {$users->count()} restricted users...");

        $propertiesCount = 0;
        $adsCount = 0;

        foreach ($users as $user) {
            // Deactivate properties
            $propertiesAffected = $user->properties()
                ->where('is_active', true)
                ->update(['is_active' => false]);

            // Deactivate advertisements using a valid state value
            try {
                $adsAffected = $user->advertisements()
                    ->where('state', '!=', 'archived')
                    ->update(['state' => 'archived']);

                $propertiesCount += $propertiesAffected;
                $adsCount += $adsAffected;
            } catch (\Exception $e) {
                $this->error("Error updating ads for user {$user->id}: " . $e->getMessage());
            }
        }

        $this->info("Deactivated {$propertiesCount} properties and {$adsCount} advertisements");

        return Command::SUCCESS;
    }
}
