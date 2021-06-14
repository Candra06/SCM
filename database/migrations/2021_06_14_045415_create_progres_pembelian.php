<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgresPembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progres_pembelian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pembelian')->unsigned();
            $table->text('keterangan');
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('id_pembelian')->references('id')->on('pembelian_barang');
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('progres_pembelian');
    }
}
