<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\InteractsWithQueue;

class SendVerifyNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;
        // Send a notification to the user
        $user->notify(new VerifyEmailNotification($user));
    }
}
