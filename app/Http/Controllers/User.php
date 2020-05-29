<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\User;
class User extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function update(Request $request) //update profil user
	{
		$data = \App\User::findOrfail(\Auth::user()->id);
		$data->phone = $request->phone;
		$data->name = $request->name;
		$data->alamat = $request->alamat;
		$data->id_alamat = $request->id_alamat;
		$data->save();

		session()->flash('success', 'Profile Anda telah diperbaharui');
		return redirect()->back();

	}
}
