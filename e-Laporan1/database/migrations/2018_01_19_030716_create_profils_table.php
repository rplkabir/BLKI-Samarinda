<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profils', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id',false,true);
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_lembaga');
            $table->string('eselonisasi');
            $table->string('provinsi');
            $table->string('kab_kota');
            $table->string('alamat');
            $table->string('no_telp');
            $table->string('no_fax');
            $table->string('email_kantor');
            $table->string('website');
            $table->string('nama_pimpinan');
            $table->string('no_hp_pimpinan');
            $table->string('foto_pimpinan');
            $table->string('foto_gedung');
            $table->string('renklakgiats');
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
        Schema::dropIfExists('profils');
    }
}
