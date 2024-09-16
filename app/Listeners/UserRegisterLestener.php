<?php

namespace App\Listeners;

use App\Models\Admin;
use App\Notifications\UserRegisterNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification ;

class UserRegisterLestener
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
        $admin=Admin::find(1);
        Notification::send($admin,new UserRegisterNotification($event->user));

    }
}
