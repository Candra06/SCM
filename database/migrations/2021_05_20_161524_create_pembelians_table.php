<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('id_tipe');
            $table->enum('metode_bayar', ['Cash', 'Credit']);
            $table->integer('jumlah_itj');
            $table->integer('harga_fix');
            $table->integer('besar_angsuran');
            $table->integer('jumlah_angsuran');
            $table->date('tanggal_itj');
            $table->enum('status', ['Lunas', 'Angsuran', 'Batal']);
            $table->foreign('id_tipe')->references('id')->on('tipe_rumah');
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
        Schema::dropIfExists('pembelian');
    }
}
