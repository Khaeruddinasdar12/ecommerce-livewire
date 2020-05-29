<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function daftar()
    {
        return redirect()->route('register');

    }

    public function masuk()
    {
        return view('user.login');
    }

    public function test()
    {
        $response = Http::asForm()->withHeaders([
            'key' => '2105cbed601c9bdfcc34806af8369575'
        ])->post('https://api.rajaongkir.com/starter/cost',[
            'origin' => 501,
            'destination' => 114,
            'weight' => 1700,
            'courier' => "pos"
        ]);

        return $response->body();
    }
    
}
