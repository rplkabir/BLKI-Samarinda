<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Renlakgiat extends Model
{
    use Sortable;
    protected $table = 'renlakgiats';
    protected $guarded = ['id'];
    public $sortable = ['users_id','kejuruan', 'program_pelatihan', 'sumber_dana', 'durasi', 'paket', 'orang', 'tgl_mulai', 'tgl_selesai'];
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
