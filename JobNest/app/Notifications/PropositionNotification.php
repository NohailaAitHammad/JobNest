<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PropositionNotification extends Notification
{
    public function __construct(
        public string $message,
        public string $type,
        public int $propositionId
    ) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'type' => $this->type,
            'proposition_id' => $this->propositionId,
        ];
    }
}
