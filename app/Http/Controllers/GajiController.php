<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gaji;
use App\Models\karyawan;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class GajiController extends Controller
{
    public function index()
    {
        // 1 Admin App , 2 Admin Sekolah
        //if (Auth::user()->role_id !== 2){
            //return abort(401); 
    //}

         $karyawan = Karyawan::all();
        return view('gaji.index',compact('karyawan'));
    }

    public function tablegaji()
    {
        $gaji = Gaji::all();

        return Datatables::of($gaji)->make(true);
    }
    public function Printpreview(){
        $gaji = Gaji::all();
        return view('gaji.Printpreview',compact('gaji'));
    }

   public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'karyawan_id' => 'required|max:255',
            'gaji' => 'required|max:255',
            'hari' => 'required|max:255',
            'jam' => 'required|max:255',
            'totalgaji' => 'required|max:255',
            
        ]);

        if ($validator->passes()) {

            $gaji = new Gaji;
            $gaji->karyawan_id = $request->karyawan_id;
            $gaji->gaji = $request->gaji;
            $gaji->hari = $request->hari;
            $gaji->jam = $request->jam;
            $gaji->totalgaji = $request->totalgaji;
           
            $gaji->save();

            return showResponseSuccess(200, 'Data berhasil ditambahkan');
        }
        return showResponseError(404, $validator->errors());
    }

    public function edit($id)
   {
    $gaji = Gaji::findOrFail($id);
    return showResponseSuccess($gaji);
   }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
           'karyawan_id' => 'required|max:255',
            'gaji' => 'required|max:255',
            'hari' => 'required|max:255',
            'jam' => 'required|max:255',
            'totalgaji' => 'required|max:255',

           
        ]);

        if ($validator->passes()) {

            $gaji = Gaji::findOrFail($id);

            $gaji->karyawan_id = $request->karyawan_id;
            $gaji->gaji = $request->gaji;
            $gaji->hari = $request->hari;
            $gaji->jam = $request->jam;
            $gaji->totalgaji = $request->totalgaji;
            
            $gaji->update();

            return showResponseSuccess(200, 'Data berhasil perbarui');
        }
        return showResponseError(404, $validator->errors());

    }

   public function deletegaji(Request $req)
    {
        if (!$req->has(['id'])) {
            return showResponseError(400, 'Parameter ID tidak tersedia');
        }

        $gaji = $req->only(['id']);

        $result = Gaji::where($gaji)->delete();

        if ($result) {
            return showResponseSuccess($result);
        } else {
            return showResponseError($result);
        }
    }

     public function store (Request $request)
    {
        //dd($jabatan);
        $validator = Validator::make($request->all(),
            [
            // Data gaji
            'karyawan_id' => 'required|max:255',
            'gaji' => 'required|max:255',
            'hari' => 'required|max:255',
            'jam' => 'required|max:255',
            'totalgaji' => 'required|max:255',
           
        ]);

        if ($validator->passes()) {

            DB::beginTransaction();
            try {
                
                $gaji = new Gaji;
	            $gaji->karyawan_id = $request->karyawan_id;
	            $gaji->gaji = $request->gaji;
	            $gaji->hari = $request->hari;
	            $gaji->jam = $request->jam;
	            $gaji->totalgaji = $request->totalgaji;
                //$siswa->created_by = Auth::id();
                //$siswa->updated_by = Auth::id();
               
                $gaji->save();
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
