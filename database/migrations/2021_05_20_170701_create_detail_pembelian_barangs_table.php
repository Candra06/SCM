<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPembelianBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembelian_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_pembelian');
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_pembelian')->references('id')->on('pembelian');
            $table->foreign('id_barang')->references('id')->on('barang');
            $table->integer('jumlah');
            $table->integer('sub_total');
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
        Schema::dropIfExists('detail_pembelian_barang');
    }
}
