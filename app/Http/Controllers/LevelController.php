<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Level;
//use App\Models\Jabatan;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
	 public function index()
    {
        // 1 Admin App , 2 Admin Sekolah
        //if (Auth::user()->role_id !== 2){
            //return abort(401); 
    //}

        $level = Level::all();        
        return view('level.index', compact('level'));
    }

     public function tablelevel()
    {
        $level = Level::all();


        return Datatables::of($level)->make(true);
    }

    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'id_level' => 'required|max:255',
            'nama_level' => 'required|max:255',
            
        ]);

         if ($validator->passes()) {

            $level = new level;
            $level->id_level = $request->id_level;
            $level->nama_level = $request->nama_level;
            
            $level->save();

            return showResponseSuccess(200, 'Data berhasil ditambahkan');
        }
        return showResponseError(404, $validator->errors());
    }

     public function edit($id)
   {
    $level = Level::findOrFail($id);
    return showResponseSuccess($level);
   }

   public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_level' => 'required|max:255',
            'nama_level' => 'required|max:255',
            
        ]);

        if ($validator->passes()) {

            $level = Level::findOrFail($id);

            $level->id = $request->id;
            $level->id_level = $request->id_level;
            $level->nama_level = $request->nama_level;
           
            $level->update();

            return showResponseSuccess(200, 'Data berhasil perbarui');
        }
        return showResponseError(404, $validator->errors());

    }

    public function deletelevel(Request $req)
    {
        if (!$req->has(['id'])) {
            return showResponseError(400, 'Parameter ID tidak tersedia');
        }

        $level = $req->only(['id']);

        $result = Level::where($level)->delete();

        if ($result) {
            return showResponseSuccess($result);
        } else {
            return showResponseError($result);
        }
    }

   
    
}
