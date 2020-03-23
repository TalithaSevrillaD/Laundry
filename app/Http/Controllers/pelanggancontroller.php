<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use JWTAuth;
use Auth;
use App\PelangganModel;

class pelanggancontroller extends Controller
{
    public function store(Request $req)
    {
        if(Auth::user()->level=="admin"){
            $validator = Validator::make($req->all(),
            [
                'nama_pelanggan'=>'required',
                'alamat'=>'required',
                'telp'=>'required'
            ]);
            if($validator->fails()){
                return Response()->json($validator->errors());
            } else {
                $simpan =  PelangganModel::create([
                    'nama_pelanggan'=>$req->nama_pelanggan,
                    'alamat'=>$req->alamat,
                    'telp'=>$req->telp
                ]);
                if($simpan){
                    $status="1";
                    $message="Data berhasil ditambahkan!";
                } else {
                    $status="0";
                    $message="Data tidak berhasil ditambahkan";
                }
                return Response()->json(compact('status','message'));
                 }
             } else {
            echo "Maaf, data hanya dapat diakses oleh admin.";
                 }
    }

    public function update($id, Request $req)
    {
        if(Auth::user()->level=="admin"){
            $validator = Validator::make($req->all(),[
                'nama_pelanggan'=>'required',
                'alamat'=>'required',
                'telp'=>'required'
            ]);

            if($validator->fails()){
                return Response()->json($validator->errors());
            }

            $ubah = PelangganModel::where('id',$id)->update([
                'nama_pelanggan'=>$req->nama_pelanggan,
                'alamat'=>$req->alamat,
                'telp'=>$req->telp
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
            echo "Maaf, data hanya dapat diakses oleh admin.";
        }
    }

    public function destroy($id)
    {
        if(Auth::user()->level=="admin"){
            $hapus = PelangganModel::where('id', $id)->delete();
            if($hapus){
                $status="1";
                $message="Data berhasil dihapus!";
            } else {
                $status="0";
                $message="Data tidak berhasil dihapus";
            }
    
            return Response()->json(compact('status','message'));
        } else {
            echo "Maaf, data hanya dapat diakses oleh admin.";
        }
    }

    public function show(){
        if(Auth::user()->level=="admin"){
            $pelanggan = PelangganModel::all();
            $status="1";

            return Response()->json(compact('pelanggan', 'status'));
        } else {
            echo "Maaf, data hanya dapat diakses oleh admin.";
        }
    }
 }

