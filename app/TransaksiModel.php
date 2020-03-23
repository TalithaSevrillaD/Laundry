<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    protected $table = "transaksi";
    protected $primaryKey="id";
    
    protected $fillable = [
        'id_pelanggan', 'id_petugas', 'tgl_transaksi', 'tgl_selesai'
    ];
}
