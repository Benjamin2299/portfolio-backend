<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewMessageNotification extends Notification
{
    use Queueable;

    public function __construct(public Message $message) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nouveau message de ' . $this->message->name)
            ->greeting('Bonjour Benjamin !')
            ->line('Vous avez recu un nouveau message depuis votre portfolio.')
            ->line('Nom : ' . $this->message->name)
            ->line('Email : ' . $this->message->email)
            ->line('Message : ' . $this->message->message)
            ->action('Voir dans le backoffice', url('/admin/messages'))
            ->salutation('Portfolio Benjamin BEUGNARE');
    }
}
