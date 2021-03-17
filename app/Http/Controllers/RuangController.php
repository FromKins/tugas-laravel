<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ruang;
//use App\Models\Jabatan;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class RuangController extends Controller
{
	 public function index()
    {
        // 1 Admin App , 2 Admin Sekolah
        //if (Auth::user()->role_id !== 2){
            //return abort(401); 
    //}

        $ruang = Ruang::all();        
        return view('ruang.index', compact('ruang'));
    }

     public function tableruang()
    {
        $ruang = Ruang::all();


        return Datatables::of($ruang)->make(true);
    }

    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'id_ruang' => 'required|max:255',
            'nama_ruang' => 'required|max:255',
            'kode_ruang' => 'required|max:255',
            'keterangan' => 'required|max:255',
            
        ]);

         if ($validator->passes()) {

            $ruang = new Ruang;
            $ruang->id_ruang = $request->id_ruang;
            $ruang->nama_ruang = $request->nama_ruang;
            $ruang->kode_ruang = $request->kode_ruang;
            $ruang->keterangan = $request->keterangan;
           
            $ruang->save();

            return showResponseSuccess(200, 'Data berhasil ditambahkan');
        }
        return showResponseError(404, $validator->errors());
    }

     public function edit($id)
   {
    $ruang = Ruang::findOrFail($id);
    return showResponseSuccess($ruang);
   }

   public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_ruang' => 'required|max:255',
            'nama_ruang' => 'required|max:255',
            'kode_ruang' => 'required|max:255',
            'keterangan' => 'required|max:255',
           
        ]);

        if ($validator->passes()) {

            $ruang = Ruang::findOrFail($id);

            $ruang->id_ruang = $request->id_ruang;
            $ruang->nama_ruang = $request->nama_ruang;
            $ruang->kode_ruang = $request->kode_ruang;
            $ruang->keterangan = $request->keterangan;
            $ruang->update();

            return showResponseSuccess(200, 'Data berhasil perbarui');
        }
        return showResponseError(404, $validator->errors());

    }

    public function deleteRuang(Request $req)
    {
        if (!$req->has(['id'])) {
            return showResponseError(400, 'Parameter ID tidak tersedia');
        }

        $ruang = $req->only(['id']);

        $result = Ruang::where($ruang)->delete();

        if ($result) {
            return showResponseSuccess($result);
        } else {
            return showResponseError($result);
        }
    }

   
    
}
