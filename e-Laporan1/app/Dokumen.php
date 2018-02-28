<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notifications;
class Dokumen extends Model
{
    protected $table = 'dokumens';
    protected $guarded = ['id'];
}

