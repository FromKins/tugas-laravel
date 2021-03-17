<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admins;
use App\Models\Roles;
use App\Models\Karyawan;
use App\Models\Level;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Response;

class UserController extends BaseControllerAdmin
{
    public function index()


    {
        // 1 Admin App , 2 Admin Sekolah
      //  if (Auth::user()->role_id !== 1){
        //    return abort(401); 
        //}

        $roles = Roles::all();
        $level = Level::all();

        return view('user.index', compact('roles','level'));
    }

    public function tableUsers()
    {
        $admin = Admins::with('role');

        return Datatables::of($admin)->make(true);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required|integer',
        ]);

        if ($validator->passes()) {

            $user = new Admins;
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->password = app('hash')->make($request->password);
            $user->id_petugas = $request->id_petugas;
            $user->id_level = $request->id_level;
            $user->role_id = $request->role_id;
            $user->created_by = Auth::id();
            $user->updated_by = Auth::id();
            $user->save();

            return showResponseSuccess(200, 'Data berhasil ditambahkan');
        }
        return showResponseError(404, $validator->errors());
    }

    public function edit($id)
    {
        // 1 Admin App , 2 Admin Sekolah
      //  if (Auth::user()->role_id !== 1){
        //    return abort(401); 
        //}

        $user = Admins::findOrFail($id);
        $roles = Roles::all();
        // $karyawan = Karyawan::all();

        
        return showResponseSuccess($user);
    }

    public function update(Request $request, $id)
    {
        // 1 Admin App , 2 Admin Sekolah
   //     if (Auth::user()->role_id !== 1){
            //return abort(401); 
     //   }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            // 'karyawan_id' => 'required|max:255',
            'role_id' => 'required|integer',
        ]);

        if ($validator->passes()) {

            $user = Admins::findOrFail($id);

            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->password = app('hash')->make($request->password);
            $user->id_petugas = $request->id_petugas;
            $user->id_level = $request->id_level;
            $user->role_id = $request->role_id;
            $user->updated_by = Auth::id();
            $user->update();

            return showResponseSuccess(200, 'Data berhasil perbarui');
        }
        return showResponseError(404, $validator->errors());
    }

    public function destroy($id)
   {
        // 1 Admin App , 2 Admin Sekolah
    //    if (Auth::user()->role_id !== 1){
      //      return abort(401); 
       // }

        $user = Admins::findOrFail($id);
        $user->delete();

        return showResponseSuccess(200, 'Data berhasil dihapus');
    }

}
