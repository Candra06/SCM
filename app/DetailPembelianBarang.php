<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPembelianBarang extends Model
{
    protected $table = 'detail_pembelian_barang';
    protected $fillable = ['id_pembelian', 'id_barang', 'jumlah', 'sub_total'];
}
