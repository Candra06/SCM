<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgresProyeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progres_proyek', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_proyek');
            $table->date('tanggal');
            $table->text('keterangan');
            $table->foreign('id_proyek')->references('id')->on('proyek');
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
        Schema::dropIfExists('progres_proyek');
    }
}
