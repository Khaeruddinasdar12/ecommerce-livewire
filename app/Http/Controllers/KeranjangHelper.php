<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\Cart;
use App\Product;
use Illuminate\Support\Facades\Http;
class KeranjangHelper extends Controller
{
    public function checkout(Request $request, $id) 
    {

    }


    public function updateJumlah(Request $request, $id)
    {
    	
        $dataperubahan= Cart::update(Product::where('id', $id)->first(), $request->jumlah);
        $data = Cart::get()['products'];
    	$jumlah = 0;
    	$berat = 0;
        foreach ($data as $total) {
            $jumlah = $jumlah + $total->subtotal;
            $berat = $berat + $total->berat;
        }
        return response()->json([
                'data' => $dataperubahan,
                'subtotal'=> $jumlah,
                'berat' => $berat
            ]);

    }

    public function cekOngkir(Request $request)
    {
        $validasi = $this->validate($request, [
            'kabupaten'     => 'required',
            'provinsi'      => 'required',
            'kurir'         => 'required',
            'berat'         => 'required|numeric'
        ],[
            'provinsi.required'  => 'Anda belum memilih provinsi',
            'kabupaten.required' => 'Anda belum memilih kabupaten',
            'kurir.required'     => 'Anda belum memilih kurir',
            'berat.required'     => 'Kok bisa beratnya kosong ?',
        ]);

    	$berat = $request->berat * 1000;
    	$response = Http::asForm()->withHeaders([
            'key' => config('app.raja_ongkir_key')
        ])->post('https://api.rajaongkir.com/starter/cost',[
            'origin' => 87, //id kabupaten bone dari table cities
            'destination' => $request->kabupaten, //id kabupaten tujuan 
            'weight' => $berat, 
            'courier' => $request->kurir
        ]);
        $data = $response['rajaongkir']['results'][0]['costs'];
        return $data;
    }
}
