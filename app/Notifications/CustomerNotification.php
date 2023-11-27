<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerNotification extends Notification
{
    use Queueable;

    protected  $post;

    public function __construct($msg,$sender = null, $type)
    {
        date_default_timezone_set('UTC');
        $this->msg = $msg ;
        $this->sender = $sender;
        $this->type = $type;
    }


    public function via($notifiable)
    {
        return ['database'];
    }



    // public function toDatabase($notifiable)
    // {
    //     return [
    //         'data' => $this->reserv,
    //         // 'user' => $this->user,
    //     ];
    // }


    public function toArray($notifiable)
    {
        return [
            'data' => $this->msg,
            'type' => $this->type,
            'sender' => $this->sender
        ];

    }
}
