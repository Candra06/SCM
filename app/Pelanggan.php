<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $fillable = ['id_akun', 'nama', 'nik', 'telepon', 'profesi', 'alamat_instansi', 'tlpn_instansi', 'alamat_domisili', 'alamat_ktp', 'status', 'created_at', 'updated_at'];
}
