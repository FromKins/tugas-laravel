<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Detailpinjam;
use App\Models\Inventaris;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class DetailpinjamController extends Controller
{
	 public function index()
    {
        // 1 Admin App , 2 Admin Sekolah
        //if (Auth::user()->role_id !== 2){
            //return abort(401); 
    //}

        $inventaris = Inventaris::all();        
        return view('detailpinjam.index', compact('inventaris'));
    }

     public function tabledetailpinjam()
    {
        $detailpinjam = Detailpinjam::all();


        return Datatables::of($detailpinjam)->make(true);
    }

    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'id_detail_pinjam' => 'required|max:255',
            'id_inventaris' => 'required|max:255',
            'jumlah' => 'required|max:255',
            
        ]);

         if ($validator->passes()) {

            $detailpinjam = new Detailpinjam;
            $detailpinjam->id_detail_pinjam = $request->id_detail_pinjam;
            $detailpinjam->id_inventaris = $request->id_inventaris;
            $detailpinjam->jumlah = $request->jumlah;
            $detailpinjam->save();

            return showResponseSuccess(200, 'Data berhasil ditambahkan');
        }
        return showResponseError(404, $validator->errors());
    }

     public function edit($id)
   {
    $detailpinjam = Detailpinjam::findOrFail($id);
    return showResponseSuccess($detailpinjam);
   }

   public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_detail_pinjam' => 'required|max:255',
            'id_inventaris' => 'required|max:255',
            'jumlah' => 'required|max:255',
           
        ]);

        if ($validator->passes()) {

            $detailpinjam = Detailpinjam::findOrFail($id);

            $detailpinjam->id = $request->id;
            $detailpinjam->id_detail_pinjam = $request->id_detail_pinjam;
            $detailpinjam->id_inventaris = $request->id_inventaris;
            $detailpinjam->jumlah = $request->jumlah;
            $detailpinjam->update();

            return showResponseSuccess(200, 'Data berhasil perbarui');
        }
        return showResponseError(404, $validator->errors());

    }

    public function deletedetailpinjam(Request $req)
    {
        if (!$req->has(['id'])) {
            return showResponseError(400, 'Parameter ID tidak tersedia');
        }

        $detailpinjam = $req->only(['id']);

        $result = Detailpinjam::where($detailpinjam)->delete();

        if ($result) {
            return showResponseSuccess($result);
        } else {
            return showResponseError($result);
        }
    }

   
    
}
