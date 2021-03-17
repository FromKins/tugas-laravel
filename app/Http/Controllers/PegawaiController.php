<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;
//use App\Models\Jabatan;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
	 public function index()
    {
        // 1 Admin App , 2 Admin Sekolah
        //if (Auth::user()->role_id !== 2){
            //return abort(401); 
    //}

        $pegawai = Pegawai::all();        
        return view('pegawai.index', compact('pegawai'));
    }

     public function tablepegawai()
    {
        $pegawai = Pegawai::all();


        return Datatables::of($pegawai)->make(true);
    }

    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'id_pegawai' => 'required|max:255',
            'nama_pegawai' => 'required|max:255',
            'nik' => 'required|max:255',
            'alamat' => 'required|max:255',
          

            
        ]);

         if ($validator->passes()) {

            $pegawai = new pegawai;
            $pegawai->id_pegawai = $request->id_pegawai;
            $pegawai->nama_pegawai = $request->nama_pegawai;
            $pegawai->nik = $request->nik;
            $pegawai->alamat = $request->alamat;
            $pegawai->save();

            return showResponseSuccess(200, 'Data berhasil ditambahkan');
        }
        return showResponseError(404, $validator->errors());
    }

     public function edit($id)
   {
    $pegawai = Pegawai::findOrFail($id);
    return showResponseSuccess($pegawai);
   }

   public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_pegawai' => 'required|max:255',
            'nama_pegawai' => 'required|max:255',
            'nik' => 'required|max:255',
            'alamat' => 'required|max:255',
        ]);

        if ($validator->passes()) {

            $pegawai = pegawai::findOrFail($id);

            $pegawai->id = $request->id;
            $pegawai->id_pegawai = $request->id_pegawai;
            $pegawai->nama_pegawai = $request->nama_pegawai;
            $pegawai->nik = $request->nik;
            $pegawai->alamat = $request->alamat;
            $pegawai->update();

            return showResponseSuccess(200, 'Data berhasil perbarui');
        }
        return showResponseError(404, $validator->errors());

    }

    public function deletepegawai(Request $req)
    {
        if (!$req->has(['id'])) {
            return showResponseError(400, 'Parameter ID tidak tersedia');
        }

        $pegawai = $req->only(['id']);

        $result = Pegawai::where($pegawai)->delete();

        if ($result) {
            return showResponseSuccess($result);
        } else {
            return showResponseError($result);
        }
    }

   
    
}
