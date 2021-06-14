<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgresPembelian extends Model
{
    protected $table = 'progres_pembelian';
    protected $fillable = ['id_pembelian', 'keterangan', 'created_by'];
}
