<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pktp extends Model
{
    //
    protected $table = 'pktps';
    protected $guarded = ['id'];

    public function User(){
    	return $this->belongsTo('App\User','users_id');
    }
}

