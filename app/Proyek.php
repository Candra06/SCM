<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    protected $table = 'proyek';
    protected $fillable = ['id_pembelian', 'id_kontraktor', 'target_selesai', 'created_at', 'updated_at'];
}
