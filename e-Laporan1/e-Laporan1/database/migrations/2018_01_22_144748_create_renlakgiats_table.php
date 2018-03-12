<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRenlakgiatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renlakgiats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kejuruan');
            $table->string('program_pelatihan');
            $table->string('sumber_dana');
            $table->string('durasi');
            $table->string('paket'); 
            $table->string('orang');
            $table->string('tgl_mulai')->nullable();
            $table->string('tgl_selesai')->nullable();
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
        Schema::dropIfExists('renlakgiats');
    }
}
