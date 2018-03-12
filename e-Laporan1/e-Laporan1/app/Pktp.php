<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Pktp extends Model
{
    use Sortable;
    
    protected $table = 'pktps';
    protected $guarded = ['id'];
    public $sortable = ['nama','nip', 'pangkat', 'jabatan', 'kedudukan', 'alamat', 'nohp'];

    public function User(){
    	return $this->belongsTo('App\User','users_id');
    }
}

