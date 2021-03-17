<?php

namespace App\Http\Controllers;
use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Admins;
use App\Models\Gaji;


class HomeController extends BaseControllerAdmin
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$nama = Karyawan::select('nama')->distinct()->get()->count();
        $nama_jabatan = Jabatan::select('nama_jabatan')->distinct()->get()->count();
        $email = Admins::select('email')->distinct()->get()->count();
        $email = Admins::select('email')->distinct()->get()->count();
        $gaji = Gaji::select('gaji')->distinct()->get()->count();
        return view('home.index',compact('nama','nama_jabatan','email','gaji'));
        
    }
}
