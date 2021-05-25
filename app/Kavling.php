<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kavling extends Model
{
    protected $table = 'kavling';
    protected $fillable = ['nama_kavling', 'no_kavling', 'status'];

    public function tipeRumah()
    {
        return $this->hashMany(Tipe::class, 'id_kavling');
    }
}
