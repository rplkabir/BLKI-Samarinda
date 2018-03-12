<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
    protected $table = 'historis';
    protected $guarded = ['id'];

    public function Renlakgiat(){
        return $this->belongsTo('App\Renlakgiat','renlakgiat_id');
    }
}
