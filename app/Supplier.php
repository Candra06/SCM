<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = "supplier";

    protected $fillable = ["id_akun", "nama", "telepon", "alamat", "status"];

    public function barang()
    {
        return $this->hasMany(Barang::class, "id_supplier");
    }
}
