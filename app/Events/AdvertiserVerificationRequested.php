<?php

namespace App\Events;

use App\Models\AdvertiserVerification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AdvertiserVerificationRequested implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $verification;

    /**
     * Create a new event instance.
     */
    public function __construct(AdvertiserVerification $verification)
    {
        $this->verification = $verification->load('submitter');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('advertiser_verifications'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'verification.created';
    }

    public function broadcastWith(): array
    {
        Log::info('[BROADCAST] Event is being sent', [
            'channel' => 'private-advertiser_verifications',
            'data' => $this->verification,
        ]);
        return [
            'verification' => $this->verification,
        ];
    }
}
