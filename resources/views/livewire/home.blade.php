@section('title')
{{config('app.name')}}
@endsection

<div class="">
  <div wire:loading class="loader" style="display: none" ></div>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{ asset('1.png') }}" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('2.jpg') }}" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('3.jpg') }}" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


      <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Produk Terbaru</h1>
      <p class="lead">Selamat Datang ! Temukan berbagai macam kebutuhan Anda di {{config('app.name')}}</p>
    </div>

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
      <div class="card-deck mb-3">
        @foreach($data as $datas)
                      @if($datas->stok > 0)
                        @php $stok = 'success'; $message = 'Stok tersedia'; $disable = ''; @endphp
                      @else
                        @php $stok = 'danger'; $message = 'Stok habis'; $disable = 'disabled'; @endphp
                      @endif
        <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="{{asset('storage/'.$datas->gambar)}}" alt="Card image cap">
                <div class="card-body">
                  <b>{{$datas->nama}}</b>
                  <p class="card-text">Rp. {{format_uang($datas->harga)}}</p>
                  <p class="card-text"><span class="badge badge-{{$stok}}">{{$message}}</span></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group" >
                      <a href="{{route('detail', ['id' => $datas->id])}}" title="Lihat detail"><button type="button" class="btn btn-sm btn-outline-dark"><i class="nav-icon fas fa-eye"></i> Detail</button></a>
                      <button wire:click="addToCart({{$datas->id}})" class="btn btn-sm btn-outline-dark" title="Tambahkan ke keranjang" {{$disable}}><i class="nav-icon fas fa-shopping-cart"></i> Keranjang</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
      </div>
      
    </div>