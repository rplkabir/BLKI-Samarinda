<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumenUptd extends Model
{
    protected $table = 'dokumen_uptds';

    public function User(){
        return $this->belongsTo('App\User','users_id');
    }
}
