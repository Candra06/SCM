<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipe extends Model
{
    protected $table = 'tipe_rumah';
    protected $fillable = ['id_kavling', 'nama_tipe', 'panjang_tanah', 'lebar_tanah', 'panjang_bangunan', 'lebar_bangunan', 'jumlah_lantai', 'harga_jual', 'desain_rumah', 'status'];

    public function kavling()
    {
        return $this->belongsTo(Kavling::class, 'id_kavling', 'id');
    }
}
