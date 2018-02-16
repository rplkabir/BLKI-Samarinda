<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profils';
    protected $guarded = ['id'];


    public function User(){
        return $this->belongsTo('App\User','users_id');
    }

}
