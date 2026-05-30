<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GuestPendingApprovalNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly User $guest)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New guest account pending approval')
            ->greeting('Hello '.$notifiable->first_name.',')
            ->line($this->guest->name.' has registered as a guest and is waiting for admin approval.')
            ->line('Organisation: '.($this->guest->organisation ?? 'Not provided'))
            ->line('Email: '.$this->guest->email)
            ->action('Review guest accounts', route('admin.users.index', ['status' => 'pending']))
            ->line('Approve the account if the request is valid.');
    }
}
