<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class Product extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$kategori = \App\Category::get();
        $count= \App\Product::count();
		$produk = \App\Product::paginate(10);
		$produk = DB::table('products')
				->join('categories', 'products.id_category', '=', 'categories.id')
				->join('users', 'products.id_admin', '=', 'users.id')
				->select('products.id', 'products.nama', 'products.berat', 'products.stok', 'products.harga', 'products.gambar', 'products.detail', 'categories.nama as kategori', 'categories.id as id_category','users.name as admin')
				->paginate(10);

		return view('admin.produk', ['kategori' => $kategori, 'produk' => $produk, 'count' => $count]);
	}

	public function store(Request $request)
	{
		$validasi = $this->validate($request, [
            'nama'      => 'required',
            'berat'		=> 'required|numeric',
            'stok' 		=> 'required|numeric|min:0',
            'harga' 	=> 'required|numeric',
            'detail' 	=> 'required',
            'gambar' 	=> 'image|mimes:jpeg,png,jpg|max:3072'
        ],[
            'nama.required'     => 'kolom nama tidak boleh kosong',
            'berat.required'	=> 'kolom berat tidak boleh kosong',
            'berat.numeric'		=> 'kolom berat harus angka',
            'stok.required'		=> 'kolom stok tidak boleh kosong',
            'stok.numeric'		=> 'kolom stok harus angka',
            'stok.min'			=> 'kolom stok minimal 0',
            'harga.required'	=> 'kolom harga tidak boleh kosong',
            'harga.numeric'		=> 'kolom harga harus angka',
            'detail.required'	=> 'kolom detail tidak boleh kosong',
            'gambar.image' 		=> 'gambar : harus format gambar'
            
        ]);

		$data = new \App\Product();
		$data->nama = $request->nama;
		$data->berat= $request->berat;
		$data->stok = $request->stok;
		$data->detail=$request->detail;
		$data->harga= $request->harga;
		$data->id_category= $request->kategori;
		$data->id_admin= \Auth::user()->id;
		$gambar = $request->file('gambar');
        if($gambar) {
            $gambar_path = $gambar->store('gambar', 'public');
            $data->gambar = $gambar_path;
        }
		$data->save();
		return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menambah Data');
	}

	public function update(Request $request, $id)
	{
		$validasi = $this->validate($request, [
            'nama'      => 'required',
            'berat'		=> 'required|numeric',
            'stok' 		=> 'required|numeric|min:0',
            'harga' 	=> 'required|numeric',
            'detail' 	=> 'required',
            'gambar' 	=> 'image|mimes:jpeg,png,jpg|max:3072'
        ],[
            'nama.required'     => 'kolom nama tidak boleh kosong',
            'berat.required'	=> 'kolom berat tidak boleh kosong',
            'berat.numeric'		=> 'kolom berat harus angka',
            'stok.required'		=> 'kolom stok tidak boleh kosong',
            'stok.numeric'		=> 'kolom stok harus angka',
            'stok.min'			=> 'kolom stok minimal 0',
            'harga.required'	=> 'kolom harga tidak boleh kosong',
            'harga.numeric'		=> 'kolom harga harus angka',
            'detail.required'	=> 'kolom detail tidak boleh kosong',
            'gambar.image' 		=> 'gambar : harus format gambar'
            
        ]);

		$data = \App\Product::findOrFail($id);
		$data->nama = $request->nama;
		$data->berat= $request->berat;
		$data->stok = $request->stok;
		$data->detail=$request->detail;
		$data->harga= $request->harga;
		$data->id_category= $request->kategori;
		$gambar = $request->file('gambar');
        if($gambar) {
        	if($data->gambar && file_exists(storage_path('app/public/' . $data->gambar))) { 
                \Storage::delete('public/'. $data->gambar);
            }
            $gambar_path = $gambar->store('gambar', 'public');
            $data->gambar = $gambar_path;
        }
		$data->save();
		return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Mengubah Data');
	}

	public function delete($id)
	{
		$data = \App\Product::findOrFail($id);
		if($data->gambar && file_exists(storage_path('app/public/' . $data->gambar))) { 
                \Storage::delete('public/'. $data->gambar);
            }
    	$data->delete();
    	return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menghapus Data');
	}
}
