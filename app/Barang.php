<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = "barang";

    protected $fillable = ["id_supplier", "nama_barang", "deskripsi", "satuan", "stok", "harga", "gambar", "status"];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, "id_supplier", "id");
    }
}
