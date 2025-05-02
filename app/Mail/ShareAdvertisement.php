<?php

namespace App\Mail;

use App\Models\Advertisement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShareAdvertisement extends Mailable
{
    use Queueable, SerializesModels;

    public $advertisement;
    public $senderEmail;
    public $messageContent;
    public $advertisementUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Advertisement $advertisement, string $senderEmail, string $subject, ?string $message, string $url)
    {
        $this->advertisement = $advertisement;
        $this->senderEmail = $senderEmail;
        $this->messageContent = $message;
        $this->advertisementUrl = $url;
        $this->subject($subject);
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails.share-advertisement')
            ->replyTo($this->senderEmail)
            ->from(config('mail.from.address'), config('app.name'))
            ->with([
                'unsubscribeUrl' => route('home')
            ])
            ->withSwiftMessage(function ($message) {
                $message->getHeaders()
                    ->addTextHeader('List-Unsubscribe', '<' . route('home') . '>')
                    ->addTextHeader('Precedence', 'bulk');
            });
    }
}
