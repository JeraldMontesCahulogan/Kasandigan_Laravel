<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;

class AdminReceivesUserVerification extends Notification
{
    use Queueable;
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New User Registration Verification')
            ->line('A new user has signed up and needs email verification.')
            ->line('User Email: ' . $this->user->email)
            ->action('Verify User', url('/email/verify/' . $this->user->id . '/' . sha1($this->user->email)));
    }
}

