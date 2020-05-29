<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
    	$data = \App\User::where('is_admin', '=', '1')->paginate(5);
    	$count = \App\User::where('is_admin', '=', '1')->count();
    	return view('admin.admin', ['data' => $data, 'count' => $count]);
    }

    public function store(Request $request)
    {
    	$validasi = $this->validate($request, [
            'nama'      => 'required',
            'password'	=> 'required|confirmed|min:8',
            'email' 	=> 'required|email|unique:users'
        ],[
            'nama.required'     => 'kolom nama tidak boleh kosong',
            'password.required'	=> 'kolom password tidak boleh kosong',
            'password.confirmed'=> 'kolom konfirmasi password tidak sama',
            'password.min'		=> 'kolom password minimal 8 digit',
            'email.required'	=> 'kolom email tidak boleh kosong',
            'email.email'		=> 'kolom email harus format email',
            'email.unique'		=> 'email ini telah terdaftar'
            
        ]);
    	$data = new \App\User();
    	$data->is_admin = 1;
    	$data->name = $request->nama;
    	$data->email = $request->email;
    	$data->phone = $request->phone;
    	$data->password = bcrypt($request->password);
    	$data->alamat = $request->alamat;
    	$data->save();

    	return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menambah Data');
    }

    public function update(Request $request, $id) //mengedit profil masing-masing
    {
    	$validasi = $this->validate($request, [
            'nama'      => 'required',
        ],[
            'nama.required'     => 'kolom nama tidak boleh kosong'
            
        ]);
    	$data = \App\User::findOrFail($id);
    	$data->name 	= $request->nama;
    	$data->phone 	= $request->phone;
    	$data->alamat	= $request->alamat;
    	$data->password = bcrypt($request->password);
    	$data->save();
    	return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Mengubah Data');

    }
}
