<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventaris;
use App\Models\Jenis;
use App\Models\Ruang;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class InventarisController extends Controller
{
	 public function index()
    {
        // 1 Admin App , 2 Admin Sekolah
        //if (Auth::user()->role_id !== 2){
            //return abort(401); 
    //}
        $jenis = Jenis::all();
        $ruang = Ruang::all();        
        return view('inventaris.index', compact('jenis','ruang'));
    }

     public function tableinventaris()
    {
        $inventaris = Inventaris::all();


        return Datatables::of($inventaris)->make(true);
    }

    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'id_inventaris' => 'required|max:255',
            'nama' => 'required|max:255',
            'kondisi' => 'required|max:255',
            'keterangan' => 'required|max:255',
            'jumlah' => 'required|max:255',
            'id_jenis' => 'required|max:255',
            'tanggal_register' => 'required|max:255',
            'id_ruang' => 'required|max:255',
            'kode_inventaris' => 'required|max:255',
			'id_petugas' => 'required|max:255',

            
        ]);

         if ($validator->passes()) {

            $inventaris = new Inventaris;
            $inventaris->id_inventaris = $request->id_inventaris;
            $inventaris->nama = $request->nama;
            $inventaris->kondisi = $request->kondisi;
            $inventaris->keterangan = $request->keterangan;
            $inventaris->jumlah = $request->jumlah;
            $inventaris->id_jenis = $request->id_jenis;
            $inventaris->tanggal_register = $request->tanggal_register;
            $inventaris->id_ruang = $request->id_ruang;
            $inventaris->kode_inventaris = $request->kode_inventaris;
            $inventaris->id_petugas = $request->id_petugas;
           
            $inventaris->save();

            return showResponseSuccess(200, 'Data berhasil ditambahkan');
        }
        return showResponseError(404, $validator->errors());
    }

     public function edit($id)
   {
    $inventaris = Inventaris::findOrFail($id);
    return showResponseSuccess($inventaris);
   }

   public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_inventaris' => 'required|max:255',
            'nama' => 'required|max:255',
            'kondisi' => 'required|max:255',
            'keterangan' => 'required|max:255',
            'jumlah' => 'required|max:255',
            'id_jenis' => 'required|max:255',
            'tanggal_register' => 'required|max:255',
            'id_ruang' => 'required|max:255',
            'kode_inventaris' => 'required|max:255',
			'id_petugas' => 'required|max:255',

           
        ]);

        if ($validator->passes()) {

            $inventaris = Inventaris::findOrFail($id);

            $inventaris->id = $request->id;
            $inventaris->id_inventaris = $request->id_inventaris;
            $inventaris->nama = $request->nama;
            $inventaris->kondisi = $request->kondisi;
            $inventaris->keterangan = $request->keterangan;
            $inventaris->jumlah = $request->jumlah;
            $inventaris->id_jenis = $request->id_jenis;
            $inventaris->tanggal_register = $request->tanggal_register;
            $inventaris->id_ruang = $request->id_ruang;
            $inventaris->kode_inventaris = $request->kode_inventaris;
            $inventaris->id_petugas = $request->id_petugas;
           
            $inventaris->update();

            return showResponseSuccess(200, 'Data berhasil perbarui');
        }
        return showResponseError(404, $validator->errors());

    }

    public function deleteinventaris(Request $req)
    {
        if (!$req->has(['id'])) {
            return showResponseError(400, 'Parameter ID tidak tersedia');
        }

        $inventaris = $req->only(['id']);

        $result = Inventaris::where($inventaris)->delete();

        if ($result) {
            return showResponseSuccess($result);
        } else {
            return showResponseError($result);
        }
    }

   
    
}
