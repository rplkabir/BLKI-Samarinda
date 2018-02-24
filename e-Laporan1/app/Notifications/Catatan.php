<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Catatan extends Notification
{
    use Queueable;

    public $jenis;
    public $nama;
    public $aidi;
    public $status;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($jenis, $nama, $aidi, $status)
    {   
        $this->jenis = $jenis;
        $this->nama = $nama;
        $this->aidi = $aidi;
        $this->status = $status;
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
            'jenis'=>$this->jenis,
            'nama'=>$this->nama,
            'aidi'=>$this->aidi,
            'status'=>$this->status,

        ];
        
    }

    public function toBroadcast($notifiable)
    {
        
        return new BroadcastMessage([
            'jenis'=>$this->jenis,
            'nama'=>$this->nama,
            'aidi'=>$this->aidi,
            'status'=>$this->status,
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
