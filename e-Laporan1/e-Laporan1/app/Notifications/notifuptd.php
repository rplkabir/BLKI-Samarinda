<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class notifuptd extends Notification
{
    use Queueable;

    public $isi;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($isi, $user)
    {   
        $this->isi = $isi;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    public function toDatabase($notifiable)
    {   
       
        return [
            'isi'=>$this->isi,
            'user'=>$this->user,
            'admin'=>'admin',

        ];
        
    }

    public function toBroadcast($notifiable)
    {
        
        return new BroadcastMessage([
            'isi'=>$this->isi,
            'user'=>$this->user,
            'admin'=>'admin',
        ]);
        
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
