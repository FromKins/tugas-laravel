<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;
use App\Models\Pegawai;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
	 public function index()
    {
        // 1 Admin App , 2 Admin Sekolah
        //if (Auth::user()->role_id !== 2){
            //return abort(401); 
    //}

        $pegawai = Pegawai::all();        
        return view('peminjaman.index', compact('pegawai'));
    }

     public function tablepeminjaman()
    {
        $peminjaman = Peminjaman::all();


        return Datatables::of($peminjaman)->make(true);
    }

    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'id_peminjaman' => 'required|max:255',
            'tanggal_pinjam' => 'required|max:255',
            'tanggal_kembali' => 'required|max:255',
            'status_peminjaman' => 'required|max:255',
            'id_pegawai' => 'required|max:255',

            
        ]);

         if ($validator->passes()) {

            $peminjaman = new Peminjaman;
            $peminjaman->id_peminjaman = $request->id_peminjaman;
            $peminjaman->tanggal_pinjam = $request->tanggal_pinjam;
            $peminjaman->tanggal_kembali = $request->tanggal_kembali;
            $peminjaman->status_peminjaman = $request->status_peminjaman;
            $peminjaman->id_pegawai = $request->id_pegawai;
           
            $peminjaman->save();

            return showResponseSuccess(200, 'Data berhasil ditambahkan');
        }
        return showResponseError(404, $validator->errors());
    }

     public function edit($id)
   {
    $peminjaman = Peminjaman::findOrFail($id);
    return showResponseSuccess($peminjaman);
   }

   public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_peminjaman' => 'required|max:255',
            'tanggal_pinjam' => 'required|max:255',
            'tanggal_kembali' => 'required|max:255',
            'status_peminjaman' => 'required|max:255',
            'id_pegawai' => 'required|max:255',

           
        ]);

        if ($validator->passes()) {

            $peminjaman = Peminjaman::findOrFail($id);

            $peminjaman->id = $request->id;
            $peminjaman->id_peminjaman = $request->id_peminjaman;
            $peminjaman->tanggal_pinjam = $request->tanggal_pinjam;
            $peminjaman->tanggal_kembali = $request->tanggal_kembali;
            $peminjaman->status_peminjaman = $request->status_peminjaman;
            $peminjaman->id_pegawai = $request->id_pegawai;
            $peminjaman->update();

            return showResponseSuccess(200, 'Data berhasil perbarui');
        }
        return showResponseError(404, $validator->errors());

    }

    public function deletepeminjaman(Request $req)
    {
        if (!$req->has(['id'])) {
            return showResponseError(400, 'Parameter ID tidak tersedia');
        }

        $peminjaman = $req->only(['id']);

        $result = Peminjaman::where($peminjaman)->delete();

        if ($result) {
            return showResponseSuccess($result);
        } else {
            return showResponseError($result);
        }
    }

   
    
}
