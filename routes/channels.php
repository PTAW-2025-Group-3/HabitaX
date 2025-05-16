<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel('App.Models.User.{id}', function (User $user, int $id) {
    return (int) $user->id === $id;
});

Broadcast::channel('advertiser_verifications', function (User $user) {
    Log::log('info', 'User is trying to access advertiser_verifications channel', [
        'user_id' => $user->id,
        'is_moderator' => $user->isModerator(),
        'is_admin' => $user->isAdmin(),
    ]);
    return $user->isModerator() || $user->isAdmin();
});
