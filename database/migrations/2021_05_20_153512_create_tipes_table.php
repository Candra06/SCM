<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipe_rumah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kavling');
            $table->string('nama_tipe', 25);
            $table->integer('panjang_tanah');
            $table->integer('lebar_tanah');
            $table->integer('panjang_bangunan');
            $table->integer('lebar_bangunan');
            $table->integer('jumlah_lantai');
            $table->integer('harga_jual');
            $table->string('desain_rumah', 35);
            $table->enum('status', ['Ready', 'Sold Out']);
            $table->foreign('id_kavling')->references('id')->on('kavling');
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
        Schema::dropIfExists('tipe_rumah');
    }
}
