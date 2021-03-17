<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use App\Models\Jabatan;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
	 public function index()
    {
        // 1 Admin App , 2 Admin Sekolah
        //if (Auth::user()->role_id !== 2){
            //return abort(401); 
    //}

        $jabatan = Jabatan::all();        
        return view('karyawan.index', compact('jabatan'));
    }

     public function tablekaryawan()
    {
        $karyawan = Karyawan::all();


        return Datatables::of($karyawan)->make(true);
    }

    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nik' => 'required|max:255',
            'nama' => 'required|max:255',
            'jk' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'id_jabatan' => 'required|max:255',
            'agama' => 'required|max:255',
            'no_tlp' => 'required|max:255',
            'alamat' => 'required|max:255',
        ]);

        if ($validator->passes()) {

            $karyawan = new Karyawan;
            $karyawan->nik = $request->nik;
            $karyawan->nama = $request->nama;
            $karyawan->jk = $request->jk;
            $karyawan->tempat_lahir = $request->tempat_lahir;
            $karyawan->tanggal_lahir = $request->tanggal_lahir;
            $karyawan->id_jabatan = $request->id_jabatan;
            $karyawan->agama = $request->agama;
            $karyawan->no_tlp = $request->no_tlp;
            $karyawan->alamat = $request->alamat;
            $karyawan->save();

            return showResponseSuccess(200, 'Data berhasil ditambahkan');
        }
        return showResponseError(404, $validator->errors());
    }

     public function edit($id)
   {
    $karyawan = Karyawan::findOrFail($id);
    return showResponseSuccess($karyawan);
   }

   public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|max:255',
            'nama' => 'required|max:255',
            'jk' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'id_jabatan' => 'required|max:255',
            'agama' => 'required|max:255',
            'no_tlp' => 'required|max:255',
            'alamat' => 'required|max:255',

           
        ]);

        if ($validator->passes()) {

            $karyawan = Karyawan::findOrFail($id);


            $karyawan->nik = $request->nik;
            $karyawan->nama = $request->nama;
            $karyawan->jk = $request->jk;
            $karyawan->tempat_lahir = $request->tempat_lahir;
            $karyawan->tanggal_lahir = $request->tanggal_lahir;
            $karyawan->id_jabatan = $request->id_jabatan;
            $karyawan->agama = $request->agama;
            $karyawan->no_tlp = $request->no_tlp;
            $karyawan->alamat = $request->alamat;
            $karyawan->update();

            return showResponseSuccess(200, 'Data berhasil perbarui');
        }
        return showResponseError(404, $validator->errors());

    }

    public function deleteKaryawan(Request $req)
    {
        if (!$req->has(['id'])) {
            return showResponseError(400, 'Parameter ID tidak tersedia');
        }

        $karyawan = $req->only(['id']);

        $result = karyawan::where($karyawan)->delete();

        if ($result) {
            return showResponseSuccess($result);
        } else {
            return showResponseError($result);
        }
    }

    public function store (Request $request)
    {
        //dd($karyawan);
        $validator = Validator::make($request->all(),
            [
            // Data karyawan
            'nik' => 'required|max:255',
            'nama' => 'required|max:255',
            'jk' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'id_jabatan' => 'required|max:255',
            'agama' => 'required|max:255',
            'no_tlp' => 'required|max:255',
            'alamat' => 'required|max:255',
        ]);

        if ($validator->passes()) {

            DB::beginTransaction();
            try {
                

            $karyawan = new Karyawan;
            $karyawan->nik = $request->nik;
            $karyawan->nama = $request->nama;
            $karyawan->jk = $request->jk;
            $karyawan->tempat_lahir = $request->tempat_lahir;
            $karyawan->tanggal_lahir = $request->tanggal_lahir;
            $karyawan->id_jabatan = $request->id_jabatan;
            $karyawan->agama = $request->agama;
            $karyawan->no_tlp = $request->no_tlp;
            $karyawan->alamat = $request->alamat;
                //$siswa->created_by = Auth::id();
                //$siswa->updated_by = Auth::id();
               
                $karyawan->save();
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
                return showResponseError(500, ['error' => $ex->getMessage()] );
            }

            return showResponseSuccess(200, 'Data berhasil ditambahkan');
        }
        return showResponseError(404, $validator->errors());
    }
    
}
