<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Angsurann extends Model
{
    protected $table = 'angsuran';
    protected $fillable = ['id_pembelian', 'status_angsuran', 'tanggal_bayar', 'created_at', 'updated_at'];
}
