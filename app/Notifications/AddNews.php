<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
class AddNews extends Notification
{
    use Queueable;
    public $new;
    public function __construct()
    {
        //
    }
    public function via($notifiable)
    {
        return ['database'];
    }
    public function toArray($new)
    {
        $this->new = $new;
        return [
            'good'=>__('admin.notify-news').' '.auth()->guard('admin')->user()->name,
        ];
    }
}
