<?php

namespace App\Listeners;

use App\Mail\WelcomMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMaileListener
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
        // Mail::to($event->user->email)->send(
        //     new WelcomMail($event->user)
        // );
    }
}
