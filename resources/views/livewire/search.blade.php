@section('title')
Search "{{$search}}""
@endsection
<div style="min-height: 28rem !important">
  <div wire:loading class="loader" style="display: none" ></div>
	<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h3 class="display-4">Hasil Pencarian : {{$search}}</h3>
    </div>
    <hr>
    @if($products->isEmpty())
		<p class="lead text-center text-danger">Tidak Ada Produk Untuk Pencarian Anda !</p>
	@endif

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
<div class="row">

@foreach($products as $product)
					@if($product->stok > 0)
                        @php $stok = 'success'; $message = 'Stok tersedia'; $disable = ''; @endphp
                      @else
                        @php $stok = 'danger'; $message = 'Stok habis'; $disable = 'disabled'; @endphp
                      @endif
<div class="col-md-3">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="{{asset('storage/'.$product->gambar)}}" alt="Card image cap">
                <div class="card-body">
                	<b>{{$product->nama}}</b>
                  <p class="card-text">Rp. {{format_uang($product->harga)}}</p>
                  <p class="card-text"><span class="badge badge-{{$stok}}">{{$message}}</span></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="{{route('detail', ['id' => $product->id])}}" title="Lihat detail"><button type="button" class="btn btn-sm btn-outline-dark"><i class="nav-icon fas fa-eye"></i> Detail</button></a>
                      <button type="button" wire:click="addToCart({{$product->id}})" class="btn btn-sm btn-outline-dark" title="Tambahkan ke keranjang" {{$disable}}><i class="nav-icon fas fa-shopping-cart"></i> Keranjang</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           @endforeach
           <hr>
    
</div>
<div class="row" >
  <div class="container">
{{$products->links()}}
</div>
 </div>
</div>
