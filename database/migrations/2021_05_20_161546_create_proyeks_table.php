<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyek', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('id_kontraktor');
            $table->unsignedInteger('id_pembelian');
            $table->date('target_selesai');
            $table->foreign('id_pembelian')->references('id')->on('pembelian');
            $table->foreign('id_kontraktor')->references('id')->on('kontraktor');

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
        Schema::dropIfExists('proyek');
    }
}
