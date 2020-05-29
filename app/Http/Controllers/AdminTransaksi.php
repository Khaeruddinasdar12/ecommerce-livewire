<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi; // table transaksis
use App\Product;
use App\Riwayat;
use DB;
class AdminTransaksi extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$data = Transaksi::where('show_user', '1')
        ->where('status', '!=', '2')
        ->orderBy('created_at', 'desc')
        ->paginate(8);
		return view('admin.transaksi', ['data' => $data]);
	}

	public function detail($id) {
		$transaksi = DB::table('transaksis')
				->join('cities', 'transaksis.id_alamat', '=', 'cities.id')
				->join('provinces', 'cities.province_id', '=', 'provinces.id')
				->select('transaksis.id', 'transaksis.nama', 'transaksis.phone', 'transaksis.alamat_lengkap', 'transaksis.total', 'transaksis.ongkir', 'transaksis.service', 'transaksis.bukti', 'transaksis.kurir', 'transaksis.status', 'transaksis.created_at', 'transaksis.service', 'cities.type', 'cities.city_name', 'provinces.nama as provinsi')
				->where('transaksis.id', $id)
				->first();
        
		$detail = DB::table('riwayats')
			->leftJoin('products', 'riwayats.id_product', '=', 'products.id')
			->select('riwayats.harga', 'riwayats.jumlah', 'riwayats.berat', 'products.nama')
			->where('riwayats.id_transaksi', $id)
			->get();

		$total = 0;
			foreach ($detail as $details) {
				$total = $total + $details->harga ; //subtotal harga pembelian (diluar ongkir)
			}

 		return view('admin.detail', ['detail' => $detail, 'transaksi' => $transaksi, 'subtotal' => $total]);
	}

	public function riwayat()
	{
		$data = Transaksi::where('status', '=', '2')
        ->orderBy('created_at', 'desc')
        ->paginate(8);
		return view('admin.riwayat', ['data' => $data]);
	}

	public function update($id)
	{
		$data = Transaksi::findOrFail($id);
		$data->status = '2';
		$data->save();

		return $arrayName = array('status' => 'success', 'pesan' => 'Berhasil mengubah data');
	}
}
