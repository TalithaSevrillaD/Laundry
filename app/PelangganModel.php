<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PelangganModel extends Model
{
    protected $table="pelanggan";
    protected $primaryKey="id";
    public $timestamps=false;
    protected $fillable = [
        'nama_pelanggan', 'alamat', 'telp'
    ];
}
