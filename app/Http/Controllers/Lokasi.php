<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Lokasi extends Controller
{
    public function semua_kabupaten($id)
    {
    	$kabupaten = \App\City::where('province_id', $id)->get();
    	return $kabupaten;
    }
}
