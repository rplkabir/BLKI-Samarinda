<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Newlaporan extends Notification
{
    use Queueable;

    public $jenis;
    public $nama;
    public $namauptd;
    public $aidi;
    public $file;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($jenis, $nama, $namauptd, $aidi, $file)
    {   
        $this->jenis = $jenis;
        $this->nama = $nama;
        $this->namauptd = $namauptd;
        $this->aidi = $aidi;
        $this->file = $file;
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
            'namauptd'=>$this->namauptd,
            'aidi'=>$this->aidi,
            'file'=>$this->file,

        ];
        
    }

    public function toBroadcast($notifiable)
    {
        
        return new BroadcastMessage([
            'jenis'=>$this->jenis,
            'nama'=>$this->nama,
            'namauptd'=>$this->namauptd,
            'aidi'=>$this->aidi,
            'file'=>$this->file,
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
