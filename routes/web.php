<?php

use Illuminate\Support\Facades\Route;

// Auth::routes(['register'=> false, 'reset'=>false]); 
Auth::routes();

Route::livewire('/', 'home')->name('home');
Route::livewire('/home', 'home')->name('home');
Route::livewire('/products', 'product-index')->name('product.index');
Route::livewire('/products/{id}', 'detail')->name('detail');
Route::livewire('/product-kategori/{kategori}', 'kategori');
Route::livewire('/pembelian', 'pembelian')->name('pembelian')->middleware('auth');
Route::livewire('/search/{string}', 'search')->name('search');
Route::livewire('/keranjang', 'cart-index')->name('cart.index');
Route::livewire('/profil', 'profil')->name('profil')->middleware('auth');

Route::put('/upload-bukti', 'KeranjangStore@upload_bukti')->name('upload'); //upload bukti pembayaran
//Footer
Route::livewire('/resources', 'resources');
Route::livewire('/features', 'features');
Route::livewire('/about', 'about');
//End Footer


// Route::get('/', 'HomeController@index');
// Route::get('/home', 'HomeController@index')->name('home');

Route::post('profil', 'User@update')->name('profil');
Route::get('/daftar', 'HomeController@daftar')->name('daftar');

Route::get('/test', 'HomeController@test');

Route::post('/keranjang', 'KeranjangStore@store')->name('keranjang.store'); //store pembelian
Route::get('/checkout/{id}', 'KeranjangStore@checkout')->name('checkout'); // melihat detaill pembelian
Route::get('detail-transaksi/{id}', 'KeranjangStore@detail')->name('detail-pembelian');//melihat detail transaksi atau pembelian
Route::get('generate-pdf/{id}', 'PdfUser@generate')->name('pdf.user');//generate pdf
//Keperluan jQuery AJAX
Route::get('data-pembelian', 'KeranjangStore@data');//menampilkan data pembelian user 
// Route::delete('data-pembelian/{id}', 'KeranjangStore@delete');//menghapus data pembelian user (softdelete)
Route::get('get-all-kabupaten/{id}', 'Lokasi@semua_kabupaten');//menentukan kabupaten 
Route::put('update-jumlah/{id}', 'KeranjangHelper@updateJumlah')->name('update-jumlah');//mengupdate jumlah di keranjang
Route::post('cek-ongkir', 'KeranjangHelper@cekOngkir')->name('cek-ongkir');//mengeck ongkos kirim
//End Keperluan jQuery AJAX



Route::group(['middleware' => 'cekAdmin'], function() {

	Route::get('admin', 'AdminDashboard@index')->name('admin.dashboard'); //dashboard admin
	Route::get('admin/managemen-transaksi', 'AdminTransaksi@index')->name('admin.index-transaksi'); //sedang bertransaksi
	Route::put('admin/managemen-transaksi/{id}', 'AdminTransaksi@update');
	Route::get('admin/managemen-transaksi/riwayat', 'AdminTransaksi@riwayat')->name('admin.riwayat-transaksi'); //riwayat transaksi
	Route::get('admin/managemen-transaksi/detail/{id}', 'AdminTransaksi@detail')->name('admin.detail-transaksi'); //riwayat transaksi

	Route::get('admin/routes', 'HomeController@admin');
	Route::get('admin/managemen-produk', 'Product@index')->name('admin.index-produk');
	Route::post('admin/managemen-produk', 'Product@store')->name('admin.store-produk');
	Route::put('admin/managemen-produk/{id}', 'Product@update');
	Route::delete('admin/managemen-produk/{id}', 'Product@delete');

	Route::get('admin/managemen-kategori', 'Category@index')->name('admin.index-kategori');
	Route::post('admin/managemen-kategori', 'Category@store')->name('admin.store-kategori');
	Route::put('admin/managemen-kategori/{id}', 'Category@update');
	Route::delete('admin/managemen-kategori/{id}', 'Category@delete');

	Route::get('admin/managemen-admin', 'Admin@index')->name('admin.index-admin');
	Route::post('admin/managemen-admin', 'Admin@store')->name('admin.store-admin');
	Route::put('admin/edit/profil/{id}', 'Admin@update'); //edit profil masing-masing
});