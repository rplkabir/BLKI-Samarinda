<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporans';
    protected $guarded = ['id'];

    public function Renlakgiat(){
        return $this->belongsTo('App\Renlakgiat','renlakgiat_id');
    }
}
