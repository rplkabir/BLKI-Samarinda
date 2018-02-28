<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Dokumen;
class User extends Authenticatable
{
    use Notifiable;

    public function unreadNotificationsByType()
    {
    // Return sorted notifications
        return $this->notifications()
                            ->whereNull('read_at')
                            ->where('type', 'App\Notifications\notifdokumen');
    }

    public function unreadNotificationsnotifcomment()
    {
    // Return sorted notifications
        return $this->notifications()
                            ->whereNull('read_at')
                             ->where('type', 'App\Notifications\Catatan');
    }

    public function Notificationsnotifcomment()
    {
    // Return sorted notifications
        return $this->notifications()
                             ->where('type', 'App\Notifications\Catatan');
    }

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function Profile(){
        return $this->hasOne(Profile::class);
    }
    public function Renlakgiat(){
        return $this->hasMany(Renlakgiat::class);
    }

    public function notifdokumen(){
        return $this->hasMany(notifdokumen::class);
    }
    public function Pktp(){
        return $this->hasMany(pktp::class);
    }
}
