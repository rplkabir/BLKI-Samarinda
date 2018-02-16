<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renlakgiat extends Model
{
    protected $table = 'renlakgiats';
    protected $guarded = ['id'];

    public function User(){
        return $this->belongsTo('App\User','users_id');
    }

    

    public function Laporan(){
        return $this->hasMany(Laporan::class);
    }

    public function Profile(){
        return $this->belongsTo('App\Profile','profile_id');
    }

    public function Histori(){
        return $this->hasMany(Histori::class);
    }
}
