<div class="navbar navbar-expand-lg navbar-light  fixed-top bg-white box-shadow border-bottom p-3 px-md-4 mb-3 ">
  <a class="navbar-brand" href="/" data-turbolinks-action="replace">{{config('app.name')}}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="float: left">
  <!-- navbar kiri -->
<ul class="navbar navbar-nav mr-auto" >
   </ul>
   <!-- End navbar kiri -->

   <form wire:submit.prevent="search" class="input-group col-md-5">
    <!-- <div class="input-group col-md-5"> -->
  <input type="text" wire:model.lazy="search" class="form-control form-control-sm @error('search') is-invalid @enderror" placeholder="cari produk">
  <div class="input-group-append is-invalid">
    <button class="btn btn-outline-secondary btn-sm" type="submit">cari</button>
  </div>
</form>

<!-- navbar kanan -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="/products" ><i class="nav-icon fas fa-box-open"></i> Semua Product</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="nav-icon fas fa-tags"></i> Kategori
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @foreach($kategori as $kategoris)
            <a class="dropdown-item" href="/product-kategori/{{$kategoris->nama}}" >{{$kategoris->nama}}</a>
          @endforeach
        </div>
      </li>
      <li class="nav-item ">
        <a class="nav-link active" href="/keranjang" ><i class="nav-icon fas fa-shopping-bag"></i> Keranjang ({{$cartTotal}})</a>
      </li>
      &nbsp;&nbsp;&nbsp;&nbsp;
      @guest
      <a href="{{route('login')}}" ><button class="btn btn-outline-info" type="button">Login</button></a> &nbsp;&nbsp;
      <a href="{{route('register')}}" ><button class="btn btn-danger" type="button">Daftar</button></a>
    @else
      <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="nav-icon fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('pembelian') }}">
                                       <i class="right fas fa-history"></i> 
                                        Pembelian
                                    </a>
                                    <a class="dropdown-item" href="{{ route('profil') }}">
                                       <i class="right fas fa-user-cog"></i> 
                                        Profil
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="right fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>

                            </li>
                    
    @endguest
  </ul>
  <!-- end navbar kanan -->
  </div>
</div>

