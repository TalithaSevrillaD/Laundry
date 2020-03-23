<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use JWTAuth;
use Auth;
use App\DetailModel;
use App\JeniscuciModel;

class detailcontroller extends Controller
{
    public function store(Request $req)
    {
        if(Auth::user()->level="petugas"){
            $validator = Validator::make($req->all(),
            [
                'id_transaksi'=>'required',
                'id_jenis'=>'required',
                'qty'=>'required'
            ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        } 

        $harga = JeniscuciModel::where('id', $req->id_jenis)->first();
        $subtotal = $harga->harga_kilo * $req->qty;

        $simpan = DetailModel::create([
            'id_transaksi'=>$req->id_transaksi,
            'id_jenis'=>$req->id_jenis,
            'subtotal'=>$subtotal,
            'qty'=>$req->qty
        ]);
        if($simpan){
            $status="1";
            $message="Data berhasil ditambahkan!";
        } else {
            $status="0";
            $message="Data tidak berhasil ditambahkan";
        }
        return Response()->json(compact('status','message'));

        } else {
            echo "Maaf, data hanya dapat diakses oleh petugas.";
        }
    }

    public function update($id, Request $req)
    {
        if(Auth::user()->level="petugas")
        {
            $validator = Validator::make($req->all(),[
                'id_transaksi'=>'required',
                'id_jenis'=>'required',
                'qty'=>'required'
            ]);

            if($validator->fails()){
                return Response()->json($validator->errors());
            }

            $harga = JeniscuciModel::where('id', $req->id_jenis)->first();
            $subtotal = $harga->harga_kilo * $req->qty;

            $ubah = DetailModel::where('id', $id)->update([
                'id_transaksi'=>$req->id_transaksi,
                'id_jenis'=>$req->id_jenis,
                'subtotal'=>$subtotal,
                'qty'=>$req->qty
            ]);
            if($ubah){
                $status="1";
                $message="Data berhasil diubah!";
            } else {
                $status="0";
                $message="Data tidak berhasil diubah";
            }
            return Response()->json(compact('status','message'));
        } else {
            echo "Maaf, data hanya dapat diakses oleh petugas.";
        }
    }

    public function destroy($id)
    {
        if(Auth::user()->level=="petugas") {
            $hapus = DetailModel::where('id', $id)->delete();
            if($hapus){
                $status="1";
                $message="Data berhasil dihapus!";
            } else {
                $status="0";
                $message="Data tidak berhasil dihapus";
            }
    
            return Response()->json(compact('status','message'));
        } else {
            echo "Maaf, anda bukan petugas.";
        }
    }

    public function show()
    {
        if(Auth::user()->level=="petugas"){
            $jenis = DetailModel::all();
            $status="1";

            return Response()->json(compact('jenis', 'status'));
        }else {
            echo "Maaf, data hanya dapat diakses oleh petugas.";
        }
    }
}
