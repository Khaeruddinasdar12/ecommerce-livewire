<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class Category extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
    public function index()
    {
    	$data = \App\Category::paginate(5);
        $count= \App\Category::count();
    	return view('admin.kategori', ['data' => $data, 'count' => $count]);
    }

    public function get_kategori()
    {
    	// $data = \App\Category::paginate(10);
    	$data = DB::table('categories');
        return $data;
    }

    public function store(Request $request)
    {
    	$validasi = $this->validate($request, [
            'nama'      => 'required',
            'thumbnail'    => 'image|mimes:jpeg,png,jpg|max:3072'
        ],[
            'nama.required'     => 'kolom nama tidak boleh kosong',
            'thumbnail.image'      => 'thumbnail : harus format gambar'
            
        ]);

    	$data = new \App\Category();
    	$data->nama = $request->nama;
        $gambar = $request->file('thumbnail');
        if($gambar) {
            $gambar_path = $gambar->store('gambar', 'public');
            $data->thumbnail = $gambar_path;
        }
    	$data->save();

    	return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menambah Data');
    	// return view('admin.kategori');
    }

    public function update(Request $request, $id)
    {
    	$validasi = $this->validate($request, [
            'nama'      => 'required'
        ],[
            'nama.required'     => 'kolom nama tidak boleh kosong'
            
        ]);
    	$data = \App\Category::findOrFail($id);
        $gambar = $request->file('thumbnail');
        if($gambar) {
            if($data->thumbnail && file_exists(storage_path('app/public/' . $data->thumbnail))) { 
                \Storage::delete('public/'. $data->thumbnail);
            }
            $gambar_path = $gambar->store('gambar', 'public');
            $data->thumbnail = $gambar_path;
        }
    	$data->nama = $request->nama;
    	$data->save();
    	return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Mengubah Data');
    }

    public function delete($id)
    {
        $cek = \App\Product::where('id_category', $id)->count();
        if ($cek > 0) {
            return $arrayName = array('status' => 'error', 'pesan' => 'Gagal! Data ini terdapat di tabel lain');
        }

        
    	$data = \App\Category::findOrFail($id);
        if($data->thumbnail && file_exists(storage_path('app/public/' . $data->thumbnail))) { 
                \Storage::delete('public/'. $data->thumbnail);
            }
    	$data->delete();
    	return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil Menghapus Data');
    }
}
