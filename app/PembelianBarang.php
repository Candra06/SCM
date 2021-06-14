<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianBarang extends Model
{
    protected $table = 'pembelian_barang';
    protected $fillable = ['id_kontraktor', 'id_supplier', 'metode_bayar', 'status', 'total'];
}
