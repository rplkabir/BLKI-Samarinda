<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('renlakgiat_id',false,true);
            $table->foreign('renlakgiat_id')->references('id')->on('renlakgiats')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tgl_mulai_lama');
            $table->date('tgl_selesai_lama');
            $table->date('tgl_mulai_baru');
            $table->date('tgl_selesai_baru');
            $table->text('alasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historis');
    }
}
