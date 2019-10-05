<?php

namespace NotificationChannels\Lob;

use Lob\Lob;
use Illuminate\Notifications\Notification;

class LobChannel
{
    /** @var \Lob\Lob */
    protected $lob;

    /**
     * @param \Lob\Lob $lob
     */
    public function __construct(Lob $lob)
    {
        $this->lob = $lob;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toLobPostcard($notifiable);

        $messageContent = $message->toArray();

        if (($address = $notifiable->routeNotificationFor('Lob')) && ! isset($messageContent['to'])) {
            $messageContent['to'] = $address;
        }

        $this->lob->{$message->type}()->create($messageContent);
    }
}
