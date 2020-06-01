<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
class PdfUser extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function generate($id)
	{
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

//  		return view('pdf', ['detail' => $detail, 'transaksi' => $transaksi, 'subtotal' => $total]);

 		$pdf = PDF::loadView('pdf', ['detail' => $detail, 'transaksi' => $transaksi, 'subtotal' => $total])->setPaper('a4', 'landscape');
        
        return $pdf->stream(config('app.name').'.pdf');
	}
}
