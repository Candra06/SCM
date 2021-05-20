<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('id_kontraktor');
            $table->unsignedBigInteger('id_supplier');
            $table->enum('metode_bayar', ['Cash', 'Credit']);
            $table->enum('status', ['Lunas', 'Angsuran', 'Batal']);
            $table->integer('total');
            $table->foreign('id_kontraktor')->references('id')->on('kontraktor');
            $table->foreign('id_supplier')->references('id')->on('supplier');
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
        Schema::dropIfExists('pembelian_barang');
    }
}
