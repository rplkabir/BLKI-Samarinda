<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    Use Notifiable;

    public function unreadNotificationsByAdmin()
    {
    // Return sorted notifications
        return $this->notifications()
                            ->whereNull('read_at')
                            ->where('type', 'App\Notifications\Newlaporan');
    }

    public function unreadNotificationsuptd()
    {
    // Return sorted notifications
        return $this->notifications()
                            ->whereNull('read_at')
                             ->where('type', 'App\Notifications\notifuptd');
    }

    protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'job_status', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
