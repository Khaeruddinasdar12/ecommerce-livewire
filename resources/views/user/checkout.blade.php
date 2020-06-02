@extends('layouts.app')


@section('title')
Checkout {{config('app.name')}}
@endsection

@section('content')
<style type="text/css">
	.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>

<div class="container" style="background-color: #f8f8ff; border-radius: 0.5%">
	<br>
	<div class="row">
		<div class="col-6">
			<div class="invoice-title">
    			<h2>Tagihan</h2>
    		</div>
		</div>
		<div class="col-6">
			<button class="btn btn-outline-danger btn-sm float-right" type="submit"><i class="nav-icon fas fa-file-pdf" ></i> Pdf</button>
		</div>
	</div>
    <div class="row">
        <div class="col-12">
    		<div class="invoice-title">
    			<h2></h2><h3 class="float-right">No. Tagihan # {{$transaksi->id}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-6">
    				<address>
    					<strong>Metode Pembayaran:</strong><br>
    					BRI 5221 8421 5007 0495 an. Khaeruddin Asdar<br>
    					<span class="text-danger">Lakukan pembayaran sesuai dengan nominal pada Total Pembayaran di bawah !</span><br>
    					<span class="text-success">Transaksi akan dibatalkan secara otomatis jika tidak melakukan pembayaran selama 24 jam (untuk keperluan testing akan diatur menjadi 5 menit) !</span>
    				</address>
    			</div>
    			<div class="col-6 text-right">
    				<address>
        			<strong>Penerima:</strong><br>
    					{{$transaksi->nama}}<br>
    					{{$transaksi->phone}}<br>
    					Provinsi {{$transaksi->provinsi}}, {{$transaksi->type}} {{$transaksi->city_name}}<br>
    					{{$transaksi->alamat_lengkap}}
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-6">
    				
    			</div>
    			<div class="col-6 text-right">
    				<address>
    					<strong>Tanggal Pembelian:</strong><br>
    					{{ date('d F Y', strtotime($transaksi->created_at)) }}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Detail Pemesanan</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Nama Barang</strong></td>
        							<td class="text-center"><strong>Harga Satuan</strong></td>
        							<td class="text-center"><strong>Jumlah</strong></td>
        							<td class="text-right"><strong>Total</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							@foreach($detail as $details)
    							<tr>
    								<td>{{$details->nama}}</td>
    								<td class="text-center">Rp. {{format_uang($details->harga)}}</td>
    								<td class="text-center">{{$details->jumlah}}</td>
    								<td class="text-right">Rp. {{format_uang($details->jumlah * $details->harga)}}</td>
    							</tr>
    							@endforeach
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">Rp. {{format_uang($subtotal)}}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Ongkir</strong></td>
    								<td class="no-line text-right">Rp. {{format_uang($transaksi->ongkir)}}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total Pembayaran</strong></td>
    								<td class="no-line text-right"><b>Rp. {{format_uang($transaksi->total + $transaksi->id)}}</b></td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
@endsection