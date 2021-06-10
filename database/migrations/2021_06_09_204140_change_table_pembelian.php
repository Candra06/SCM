<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeTablePembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pembelian', function (Blueprint $table) {
            $table->bigInteger('id_pelanggan')->unsigned()->after('id_tipe');
            $table->text('metode_bayar')->nullable()->change();
            $table->text('jumlah_itj')->nullable()->change();
            $table->text('harga_fix')->nullable()->change();
            $table->text('besar_angsuran')->nullable()->change();
            $table->text('jumlah_angsuran')->nullable()->change();
            
            $table->text('tanggal_itj')->nullable()->change();

            $table->foreign('id_pelanggan')->references('id')->on('pelanggan');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembelian', function (Blueprint $table) {
            //
        });
    }
}
