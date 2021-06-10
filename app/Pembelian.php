<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = "pembelian";
    protected $fillable = ['id_tipe','id_pelanggan', 'metode_bayar','jumlah_itj', 'harga_fix', 'besar_angsuran', 'jumlah_angsuran', 'tanggal_itj', 'status'];
}
