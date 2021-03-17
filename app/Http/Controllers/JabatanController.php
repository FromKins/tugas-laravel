<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jabatan;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
     public function index()
    {
        // 1 Admin App , 2 Admin Sekolah
        //if (Auth::user()->role_id !== 2){
            //return abort(401); 
    //}
        
        return view('jabatan.index');
    }

    public function tablejabatan()
    {
        $jabatan = Jabatan::all();

        return Datatables::of($jabatan)->make(true);
    }

   public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'id_jabatan' => 'required|max:255',
            'nama_jabatan' => 'required|max:255',
            
        ]);

        if ($validator->passes()) {

            $jabatan = new Jabatan;
            $jabatan->id_jabatan = $request->id_jabatan;
            $jabatan->nama_jabatan = $request->nama_jabatan;
           
            $jabatan->save();

            return showResponseSuccess(200, 'Data berhasil ditambahkan');
        }
        return showResponseError(404, $validator->errors());
    }

    public function edit($id)
   {
    $jabatan = Jabatan::findOrFail($id);
    return showResponseSuccess($jabatan);
   }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_jabatan' => 'required|max:255',
            'nama_jabatan' => 'required|max:255',
            

           
        ]);

        if ($validator->passes()) {

            $jabatan = Jabatan::findOrFail($id);


            $jabatan->id_jabatan = $request->id_jabatan;
            $jabatan->nama_jabatan = $request->nama_jabatan;
            
            $jabatan->update();

            return showResponseSuccess(200, 'Data berhasil perbarui');
        }
        return showResponseError(404, $validator->errors());

    }

   public function deletejabatan(Request $req)
    {
        if (!$req->has(['id'])) {
            return showResponseError(400, 'Parameter ID tidak tersedia');
        }

        $jabatan = $req->only(['id']);

        $result = Jabatan::where($jabatan)->delete();

        if ($result) {
            return showResponseSuccess($result);
        } else {
            return showResponseError($result);
        }
    }

     public function store (Request $request)
    {
        dd($jabatan);
        $validator = Validator::make($request->all(),
            [
            // Data jabatan
            'id_jabatan' => 'required|max:255',
            'nama_jabatan' => 'required|max:255',
           
        ]);

        if ($validator->passes()) {

            DB::beginTransaction();
            try {
                

                $jabatan = new Jabatan;
                $jabatan->id_jabatan = $request->id_jabatan;
                $jabatan->nama_jabatan = $request->nama_jabatan;
                //$siswa->created_by = Auth::id();
                //$siswa->updated_by = Auth::id();
               
                $jabatan->save();
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
                return showResponseError(500, ['error' => $ex->getMessage()] );
            }

            return showResponseSuccess(200, 'Data berhasil di perbarui');
        }
        return showResponseError(404, $validator->errors());
    }
    //
}
