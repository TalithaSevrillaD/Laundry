<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use JWTAuth;
use Auth;
use App\JeniscuciModel;

class jeniscontroller extends Controller
{
    public function store(Request $req)
    {
        if(Auth::user()->level="admin"){
            $validator = Validator::make($req->all(),
            [
                'nama_jenis'=>'required',
                'harga_kilo'=>'required'
            ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        } else {
        $simpan = JeniscuciModel::create([
            'nama_jenis'=>$req->nama_jenis,
            'harga_kilo'=>$req->harga_kilo
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
        if(Auth::user()->level="admin")
        {
            $validator = Validator::make($req->all(),[
                'nama_jenis'=>'required',
                'harga_kilo'=>'required'
            ]);

            if($validator->fails()){
                return Response()->json($validator->errors());
            }

            $ubah = JeniscuciModel::where('id', $id)->update([
                'nama_jenis'=>$req->nama_jenis,
                'harga_kilo'=>$req->harga_kilo
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
            echo "Maaf, data hanya dapat diakses oleh admin";
        }
    }

    public function destroy($id)
    {
        if(Auth::user()->level=="admin") {
            $hapus = JeniscuciModel::where('id', $id)->delete();
            if($hapus){
                $status="1";
                $message="Data berhasil dihapus!";
            } else {
                $status="0";
                $message="Data tidak berhasil dihapus";
            }
    
            return Response()->json(compact('status','message'));
        } else {
            echo "Maaf, anda bukan admin.";
        }
    }

    public function show()
    {
        if(Auth::user()->level=="admin"){
            $jenis = JeniscuciModel::all();
            $status="1";

            return Response()->json(compact('jenis', 'status'));
        }else {
            echo "Maaf, data hanya dapat diakses oleh admin.";
        }
    }
}
