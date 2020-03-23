<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use JWTAuth;
use Auth;
use App\TransaksiModel;
use DB;

class Transaksicontroller extends Controller
{
    public function store(Request $req)
    {
        if(Auth::user()->level=="petugas"){
            $validator = Validator::make($req->all(),
            [
                'id_pelanggan'=>'required',
                'id_petugas'=>'required',
                'tgl_transaksi'=>'required',
                'tgl_selesai'=>'required'
            ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        } else {
        $simpan = TransaksiModel::create([
            'id_pelanggan'=>$req->id_pelanggan,
            'id_petugas'=>$req->id_petugas,
            'tgl_transaksi'=>$req->tgl_transaksi,
            'tgl_selesai'=>$req->tgl_selesai
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
            echo "Maaf, data hanya dapat diakses oleh petugas.";
        }
    }

    public function update($id, Request $req)
    {
        if(Auth::user()->level=="petugas")
        {
            $validator = Validator::make($req->all(),[
                'id_pelanggan'=>'required',
                'id_petugas'=>'required',
                'tgl_transaksi'=>'required',
                'tgl_selesai'=>'required'
            ]);

            if($validator->fails()){
                return Response()->json($validator->errors());
            }

            $ubah = TransaksiModel::where('id', $id)->update([
                'id_pelanggan'=>$req->id_pelanggan,
                'id_petugas'=>$req->id_petugas,
                'tgl_transaksi'=>$req->tgl_transaksi,
                'tgl_selesai'=>$req->tgl_selesai
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
            echo "Maaf, data hanya dapat diakses oleh petugas";
        }
    }

    public function destroy($id)
    {
        if(Auth::user()->level=="petugas") {
            $hapus = TransaksiModel::where('id', $id)->delete();
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

    public function show(Request $r)
    {
        if(Auth::user()->level=="petugas"){
            $trans = DB::table('transaksi')
                ->join('pelanggan', 'pelanggan.id', '=', 'transaksi.id_pelanggan')
                ->join('petugas', 'petugas.id', '=', 'transaksi.id_petugas')
                ->where('transaksi.tgl_transaksi', '>=', $r->tgl_awal)
                ->where('transaksi.tgl_transaksi', '<=', $r->tgl_akhir)
                ->select('transaksi.tgl_transaksi', 'pelanggan.nama_pelanggan', 'pelanggan.alamat',
                        'pelanggan.telp', 'transaksi.tgl_selesai', 'transaksi.id')
                ->get();
            $hasil = array();
            foreach($trans as $t){
                $grand = DB::table('detail')
                    ->where('id_transaksi', '=', $t->id)
                    ->groupBy('id_transaksi')
                    ->select(DB::raw('sum(subtotal) as grandtotal'))
                    ->first();
                $detail = DB::table('detail')
                    ->join('jenis_cuci', 'jenis_cuci.id', '=', 'detail.id_jenis')
                    ->where('id_transaksi', '=', $t->id)
                    ->select('detail.*', 'jenis_cuci.*')
                    ->get();
                $hasil2 = array();

                foreach($detail as $d){
                    $hasil2[]= array(
                        'id_transaksi'=>$d->id_transaksi,
                        'jenis cuci'=>$d->nama_jenis,
                        'berat'=>''.$d->qty.' kg',
                        'harga per kg'=>$d->harga_kilo,
                        'subtotal'=>$d->subtotal
                    );
                }

                $hasil[]= array(
                    'tanggal transaksi'=>$t->tgl_transaksi,
                    'nama_pelanggan'=>$t->nama_pelanggan,
                    'alamat'=>$t->alamat,
                    'telepon'=>$t->telp,
                    'tanggal selesai'=>$t->tgl_selesai,
                    'total transaksi'=> @$grand->grandtotal,
                    'detail transaksi'=>$hasil2
                );
            }
            return Response()->json(compact('hasil'));
        }else {
            echo "Maaf, data hanya dapat diakses oleh petugas.";
        }
    }
}
