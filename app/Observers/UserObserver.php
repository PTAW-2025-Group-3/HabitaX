<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $restrictedStates = ['suspended', 'banned', 'archived'];

        // Check if state was changed
        if ($user->isDirty('state')) {
            // If changed to a restricted state
            if (in_array($user->state, $restrictedStates)) {
                $this->deactivateUserContent($user);
            }
            // If changed from a restricted state to active
            elseif ($user->state === 'active' && in_array($user->getOriginal('state'), $restrictedStates)) {
                $this->reactivateUserContent($user);
            }
        }
    }

    /**
     * Deactivate all content created by the user
     */
    protected function deactivateUserContent(User $user): void
    {
        // Deactivate properties
        $user->properties()->update(['is_active' => false]);

        // Archive advertisements
        $user->advertisements()->update(['state' => 'archived']);
    }

    /**
     * Reactivate properties when user becomes active again
     * Advertisements will remain archived
     */
    protected function reactivateUserContent(User $user): void
    {
        // Reactivate only the properties
        $user->properties()->update(['is_active' => true]);

        // Advertisements remain in archived state
    }
}
