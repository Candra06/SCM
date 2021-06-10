<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgresProyek extends Model
{
    protected $table = 'progres_proyek';
    protected $fillable = ['id_proyek', 'tanggal', 'keterangan', 'created_at', 'updated_at'];
}
