<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends Notification
{
    use Queueable;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->user = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Job Portals account verification')
            ->view(
                'mail.verify-email-notification',
                [
                    'verifyLink' => url(config('variables.verify_redirect_url') . $this->user['remember_token'] . '/' . $this->user['email']),
                    'name' => $this->user['name'] . ' ' . $this->user['last_name'],
                ]
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'heading' => __('notifications.user-created-heading'),
            'message' => __('notifications.user-created',),
            'page' => 'DASHBOARD',
        ];
    }
}
