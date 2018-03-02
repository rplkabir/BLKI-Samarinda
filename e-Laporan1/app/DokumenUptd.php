<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notifications;

class DokumenUptd extends Model
{
	use Notifiable;
	
    protected $table = 'dokumen_uptds';

    public function User(){
        return $this->belongsTo('App\User','users_id');
    }
}
