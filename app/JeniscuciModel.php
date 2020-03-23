<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JeniscuciModel extends Model
{
    protected $table="jenis_cuci";
    protected $primaryKey ="id";
    public $timestamps=false;
    protected $fillable = [
        'nama_jenis', 'qty','harga_kilo'
    ];
}
