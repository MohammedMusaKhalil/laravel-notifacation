<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class UserRegisterNotification extends Notification
{
    use Queueable;
public $user;
    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user=$user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }



    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->greeting($this->user['greeting'])
    //                 ->line($this->user['body'])
    //                 ->action($this->user['actiontext'], $this->user['actionurl'])
    //                 ->line($this->user['lastline']);
    // }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'name'=>$this->user->name,
            'email'=>$this->user->email,
        ];
    }
}
