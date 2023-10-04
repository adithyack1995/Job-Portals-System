<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Broadcast;

class NotifyAdmins
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
    public function handle(object $event): void
    {
        if (auth()->check()) {
            Broadcast::to('job-application')->with(['user' => $event->user])->broadcast();
        }
    }
}
