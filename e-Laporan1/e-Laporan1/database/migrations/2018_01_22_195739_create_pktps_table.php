<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePktpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pktps', function (Blueprint $table) {
            $table->increments('id');
            $table->String('nama');
            $table->String('nip');
            $table->String('pangkat');
            $table->String('jabatan');
            $table->String('kedudukan');
            $table->String('alamat');
            $table->String('nohp');
            $table->String('foto');
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
        Schema::dropIfExists('pktps');
    }
}
