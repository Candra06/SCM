<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontraktor extends Model
{
    protected $table = 'kontraktor';
    protected $fillable = ["id_akun", "nama", "telepon", "alamat", "status", "created_at", "updated_at"];
}
