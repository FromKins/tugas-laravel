<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jenis;
//use App\Models\Jabatan;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class jenisController extends Controller
{
	 public function index()
    {
        // 1 Admin App , 2 Admin Sekolah
        //if (Auth::user()->role_id !== 2){
            //return abort(401); 
    //}

        $jenis = Jenis::all();        
        return view('jenis.index', compact('jenis'));
    }

     public function tablejenis()
    {
        $jenis = Jenis::all();


        return Datatables::of($jenis)->make(true);
    }

    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'id_jenis' => 'required|max:255',
            'nama_jenis' => 'required|max:255',
            'kode_jenis' => 'required|max:255',
            
        ]);

         if ($validator->passes()) {

            $jenis = new Jenis;
            $jenis->id_jenis = $request->id_jenis;
            $jenis->nama_jenis = $request->nama_jenis;
            $jenis->kode_jenis = $request->kode_jenis;
            $jenis->keterangan = $request->keterangan;
           
            $jenis->save();

            return showResponseSuccess(200, 'Data berhasil ditambahkan');
        }
        return showResponseError(404, $validator->errors());
    }

     public function edit($id)
   {
    $jenis = jenis::findOrFail($id);
    return showResponseSuccess($jenis);
   }

   public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_jenis' => 'required|max:255',
            'nama_jenis' => 'required|max:255',
            'kode_jenis' => 'required|max:255',
           
        ]);

        if ($validator->passes()) {

            $jenis = Jenis::findOrFail($id);

            $jenis->id = $request->id;
            $jenis->id_jenis = $request->id_jenis;
            $jenis->nama_jenis = $request->nama_jenis;
            $jenis->kode_jenis = $request->kode_jenis;
            $jenis->keterangan = $request->keterangan;
            $jenis->update();

            return showResponseSuccess(200, 'Data berhasil perbarui');
        }
        return showResponseError(404, $validator->errors());

    }

    public function deleteJenis(Request $req)
    {
        if (!$req->has(['id'])) {
            return showResponseError(400, 'Parameter ID tidak tersedia');
        }

        $jenis = $req->only(['id']);

        $result = Jenis::where($jenis)->delete();

        if ($result) {
            return showResponseSuccess($result);
        } else {
            return showResponseError($result);
        }
    }

   
    
}
