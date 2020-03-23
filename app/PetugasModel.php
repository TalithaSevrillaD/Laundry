<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetugasModel extends Model
{
    protected $table="petugas";
    protected $primaryKey="id";
    public $timestamps =false;
    protected $fillable = [
        'id', 'nama_petugas', 'telp', 'username', 'password', 'level'
    ];
}
