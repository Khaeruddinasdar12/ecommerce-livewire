@section('title')
Detail Produk
@endsection
<div class="container">
	@if (session()->has('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ session('error') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @elseif(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session('success') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
<div class="row" style="min-height: 28rem !important">
	<div class="col-md-6">
		<img class="card-img-top" src="{{asset('storage/'.$detail->gambar)}}" alt="Card image cap">
		<!-- <img src="{{asset('test.png')}}" height="220" width="200"> -->
	</div>
    <div class="col-md-6">
    	@if($detail->stok > 0)
                        @php $stok = 'success'; $message = 'Stok tersedia'; $disable = ''; @endphp
                      @else
                        @php $stok = 'danger'; $message = 'Stok habis'; $disable = 'disabled'; @endphp
                      @endif
    	<div class="card box-shadow">
                <div class="card-body">
                	<b>{{$detail->nama}}</b>
                  <p class="card-text">Rp. {{format_uang($detail->harga)}}</p>
                  <p class="card-text"><span class="badge badge-{{$stok}}">{{$message}} : {{$detail->stok}}</span></p>
                  <div class="btn-group">
                      <button type="button" wire:click="addToCart({{$detail->id}})" class="btn btn-sm btn-outline-dark" title="Tambahkan ke keranjang" {{$disable}}><i class="nav-icon fas fa-shopping-cart"></i> Keranjang</button>
                    </div>
                  <p class="card-text">{{$detail->detail}}</p>
                  <div class="d-flex justify-content-between align-items-center">
                    
                  </div>
                </div>
              </div>
    </div> 
</div>
</div>