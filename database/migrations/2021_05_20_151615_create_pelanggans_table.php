<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelanggansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_akun');
            $table->string('nama', 40);
            $table->string('nik', 16);
            $table->string('telepon', 13);
            $table->string('profesi', 20)->nullable();
            $table->string('instansi', 40)->nullable();
            $table->text('alamat_instansi')->nullable();
            $table->string('tlpn_instansi', 13)->nullable();
            $table->text('alamat_domisili')->nullable();
            $table->text('alamat_ktp');
            $table->enum('status', ['Aktif', 'Banned']);
            $table->foreign('id_akun')->references('id')->on('users');
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
        Schema::dropIfExists('pelanggan');
    }
}
