<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKavlingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kavling', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kavling', 35);
            $table->string('no_kavling', 2);
            $table->enum('status', ['Ready', 'Sold Out']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kavling');
    }
}
