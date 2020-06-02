<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Riwayat;
use App\Facades\Cart;
use App\Product;
use DB;

class KeranjangStore extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function upload_bukti(Request $request) // mengupload Bukti Pembayaran
	{
		$validasi = $this->validate($request, [
            'gambar' 	=> 'image|mimes:jpeg,png,jpg|max:3072'
        ],[
            'gambar.image' 		=> 'gambar harus format gambar'
        ]);

		$data = Transaksi::findOrFail($request->id);
		if($data->user_id != \Auth::user()->id) {
			abort(403);
		}
		$gambar = $request->file('gambar');
        if($gambar) {
        	if($data->bukti && file_exists(storage_path('app/public/' . $data->bukti))) { 
                \Storage::delete('public/'. $data->bukti);
            }
            $gambar_path = $gambar->store('gambar', 'public');
            $data->bukti = $gambar_path;
        }
        $data->save();

        session()->flash('success', 'Bukti pembayaran telah dikirim');
		return redirect()->back();
	}

	public function detail($id) {
		// $transaksi = Transaksi::findOrFail($id);
		// if($transaksi->user_id != \Auth::user()->id) {
		// 	abort(403);
		// }
		$transaksi = DB::table('transaksis')
				->join('cities', 'transaksis.id_alamat', '=', 'cities.id')
				->join('provinces', 'cities.province_id', '=', 'provinces.id')
				->select('transaksis.id', 'transaksis.nama', 'transaksis.phone', 'transaksis.alamat_lengkap', 'transaksis.total', 'transaksis.ongkir', 'transaksis.service', 'transaksis.bukti', 'transaksis.kurir', 'transaksis.status', 'transaksis.service', 'transaksis.created_at', 'cities.type', 'cities.city_name', 'provinces.nama as provinsi')
				->where('transaksis.id', $id)
				->where('transaksis.user_id', \Auth::user()->id)
				->first();
		// return $transaksi->id;

		if(!$transaksi){
			abort(404);
		}
		$detail = DB::table('riwayats')
			->leftJoin('products', 'riwayats.id_product', '=', 'products.id')
			->select('riwayats.harga', 'riwayats.jumlah', 'riwayats.berat', 'products.nama')
			->where('riwayats.id_transaksi', $id)
			->get();

		$total = 0;
			foreach ($detail as $details) {
				$total = $total + $details->harga ; //subtotal harga pembelian (diluar ongkir)
			}

 		return view('user.detail', ['detail' => $detail, 'transaksi' => $transaksi, 'subtotal' => $total]);
	}
	
	public function data() 
	{
		$data = Transaksi::where('user_id', \Auth::user()->id)->where('show_user', '1')->get();
		return $data;
	}

	public function delete($id) 
	{
		$data = Transaksi::find($id);
		$data->show_user = '0';
		$data->save();
	} 


	public function store(Request $request)
	{
		$validasi = $this->validate($request, [
            'nama'      => 'required',
            'nohp'	=> 'required',
            'alamat' 	=> 'required',
            'kabupaten' => 'required',
            'total' => 'required'
        ],[
            'nama.required'     => 'kolom nama tidak boleh kosong',
            'nohp.required'		=> 'kolom nohp tidak boleh kosong',
            'alamat.required'	=> 'kolom alamat tidak boleh kosong',
            'kabupaten.required'=> 'Anda belum memilih kabupaten',
            'total.required'	=> 'cek Ongkir terlebih dahulu'
            
        ]);

		$data = Cart::get()['products'];

		foreach($data as $datas) {
			$stok = Product::find($datas['id']);
			$cek_stok = $stok->stok;
			if ($cek_stok < $datas['jumlah']) {
				session()->flash('error', 'Stok produk '.$datas->nama.' tidak cukup, mohon cek detail produk !');
				return redirect()->back();
			}
        }

         // input ke tabel transaksis
        $transaksi = new Transaksi();
		$transaksi->nama = $request->nama;
		$transaksi->phone = $request->nohp;
		$transaksi->alamat_lengkap = $request->alamat;
		$transaksi->id_alamat = $request->kabupaten;
		$transaksi->total = $request->total;
		$transaksi->ongkir = $request->ongkir;
		$transaksi->kurir = $request->kurir;
		$transaksi->show_user = '1';
		$transaksi->service = $request->service;
		$transaksi->user_id = \Auth::user()->id;
		$transaksi->status = '0';
		$transaksi->save();
		// end input ke tabel transaksis

        foreach ($data as $datas) {
        	$kurangi_stok = Product::find($datas['id']);
        	$kurangi_stok->stok = $kurangi_stok->stok - $datas['jumlah'];
        	$kurangi_stok->save(); 
        	$data_riwayat[] = [
        		'id_transaksi' 	=> $transaksi->id,
        		'id_product' 	=> $datas['id'], // id produk dari table Produk (session)
        		'harga' 		=> $datas['harga'], //harga satuan
        		'jumlah' 		=> $datas['jumlah'], // qty pembelian
        		'berat' 		=> $datas['berat'] // total berat
        	];
        }

        Riwayat::insert($data_riwayat); // input data ke tabel riwayats

        Cart::clear(); // membersihkan session
        // return 'Berhasil menambah data';
        return redirect()->route('checkout', ['id' => $transaksi->id]);
	}

	public function checkout($id) // untuk menampilkan halaman setelah checkout
	{
// 		$transaksi = Transaksi::findOrFail($id);
		$transaksi = DB::table('transaksis')
				->join('cities', 'transaksis.id_alamat', '=', 'cities.id')
				->join('provinces', 'cities.province_id', '=', 'provinces.id')
				->select('transaksis.id', 'transaksis.nama', 'transaksis.phone', 'transaksis.alamat_lengkap', 'transaksis.total', 'transaksis.ongkir', 'transaksis.service', 'transaksis.bukti', 'transaksis.kurir', 'transaksis.status', 'transaksis.service', 'transaksis.created_at', 'cities.type', 'cities.city_name', 'provinces.nama as provinsi')
				->where('transaksis.id', $id)
				->where('transaksis.user_id', \Auth::user()->id)
				->first();
				
		if(!$transaksi) {
			abort(404);
		}
		$detail = DB::table('riwayats')
			->leftJoin('products', 'riwayats.id_product', '=', 'products.id')
			->select('riwayats.harga', 'riwayats.jumlah', 'riwayats.berat', 'products.nama')
			->where('riwayats.id_transaksi', $id)
			->get();

		$total = 0;
			foreach ($detail as $details) {
				$total = $total + $details->harga ; //subtotal harga pembelian (diluar ongkir)
			}


 		return view('user.checkout', ['detail' => $detail, 'transaksi' => $transaksi, 'subtotal' => $total]);
	}
}
