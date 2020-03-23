<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailModel extends Model
{
    protected $table="detail";
    protected $primaryKey="id";
    public $timestamps = false;
    protected $fillable = [
        'id_transaksi', 'id_jenis', 'subtotal','qty'
    ];
}
