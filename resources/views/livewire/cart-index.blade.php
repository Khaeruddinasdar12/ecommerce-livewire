@section('title')
Keranjang {{config('app.name')}}
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/toastr/toastr.min.css') }}">
@endsection

<div class="container " style="min-height: 28rem !important">
<div wire:loading class="loader" style="display: none" ></div>
  @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

  @if (session()->has('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ session('error') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
@if($cart['products'] == null)
<div class="table-responsive">
  <table class="table">
    <tr>
      <td colspan="5" class="text-center text-success">Tidak Ada Keranjang !</td>
    </tr>
  </table>
</div>
@else
<div class="table-responsive">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Nama</th>
      <th scope="col">Harga</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Berat</th>
      <th scope="col">Subtotal</th>
      <th scope="col" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($cart['products'] as $product)
    <tr>
      <td>{{ $product->nama}}</td>
      <td>Rp. {{format_uang($product->harga)}}</td>
      <td>
        <form method="POST" id="update-jumlah-{{$product->id}}" >
        <div class="input-group">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" value="{{$product->id}}" id="product-id-{{$product->id}}">
            <input type="number" min="1" class="form-control form-control-sm" value="{{$product->jumlah}}" name="jumlah">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary btn-sm" type="submit" onclick="updateJumlah({{$product->id}})"> update</button>
            </div>
          </div>
          </form>
        </td>
      <td id="berat-{{$product->id}}">{{$product->berat}} kg</td>
      <td id="harga-{{$product->id}}">Rp. {{ format_uang($product->subtotal) }}</td>
      <td class="text-center"><a href="{{route('detail', ['id' => $product->id])}}" title="Detail"><button type="button" class="btn btn-sm btn-outline-info"><i class="nav-icon fas fa-eye"></i> </button></a>
        <button class="btn btn-outline-danger btn-sm" wire:click="removeItem({{$product->id}})" title="Hapus"><i class="nav-icon fas fa-trash"></i></button></td>
    </tr>
    @endforeach
	  	<tr>
	  		<td colspan="2"><span class="text-danger">Klik tombol update setelah mengubah jumlah barang !</span></td>
	  		<td><b>Total belanja</b></td>
        <td><b id="berat">{{$berat}} Kg</b></td>
        <td ><b id="matotal">Rp. {{format_uang($total)}}</b></td>
        <td></td>
      </tr>
      </tbody>
</table>
</div>
<div class="row">
  <div class="col-md-8">
    <strong>Detail Pengiriman : </strong>
    <hr>
    
    <div class="row">
        <div class="col-md-6">
          <label for="validationDefault03">Nama Lengkap</label>
          <input type="text" class="form-control"  id="nama-send" onkeyup="nama()" @guest placeholder="Khaeruddin Asdar" @else value="{{ Auth::user()->name }}" @endif >
        </div>
        <div class="col-md-6">
          <label for="validationDefault04">No HP</label>
          <input type="text" class="form-control"  id="nohp-send" onkeyup="nohp()"  @guest placeholder="cth. 08234494950x" @else value="{{ Auth::user()->phone }}" @endif>
        </div>
    </div>
    <form method="post"  id="cek-ongkir">
      @csrf
      <input type="hidden" name="berat" id="berat-form" value="{{$berat}}">
      <div class="row">
        <div class="col-md-6">
          <label for="validationDefault01">Provinsi </label>
          <select class="form-control" id="provinsi" onchange="show_kabupaten()" name="provinsi">
            <option value="">--Pilih provinsi--</option>
            @foreach($provinsi as $prov)
            <option value="{{$prov->id}}">{{$prov->nama}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-6">
          <label for="validationDefault02">Kabupaten/kota</label>
          <select class="form-control" id="kabupaten" name="kabupaten">
          </select>
        </div>
      </div>
      <div class="row">
      <div class="col-md-12">
          <label for="validationDefault03">Alamat Lengkap</label>
          <textarea class="form-control" rows="2" id="alamat-send" onkeyup="alamat()"></textarea>
        </div>
    </div>
      <div class="row">
        <div class="col-md-4">
          <label for="validationDefaultUsername">Kurir</label>
          <select class="form-control" id="kurir" name="kurir">
            @foreach($kurir as $kurirs)
              <option value="{{$kurirs->code}}">{{$kurirs->title}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4">
          <label for="">Cek ongkir</label>
          <button class="btn btn-outline-dark btn-md form-control" type="submit"><i class="nav-icon fas fa-info" ></i> Cek Ongkir</button>
        </div>
      </form>
  </div>
</div>
  <div class="col-md-4">
    <div class="card box-shadow">
      <div class="card-body">
        Pilih Paket Pengiriman
        <div id="paket"> 
        </div>
                  <table>
                    <tr>
                      <td>Kota Asal Pengiriman</td>
                      <td> : </td>
                      <td>Kabupaten Bone</td>
                    </tr>
                    <tr>
                      <td>Subtotal</td>
                      <td> : </td>
                      <td id="matotal1">Rp. {{format_uang($total)}}</td>
                    </tr>
                    <tr>
                      <td>Ongkir</td>
                      <td> : </td>
                      <td id="ongkir">Rp. -, </td>
                    </tr>
                    <tr>
                      <td>Nama service</td>
                      <td> : </td>
                      <td id="service"> -, </td>
                    </tr>
                    <tr>
                      <td><b>Total Pembayaran</b></td>
                      <td> : </td>
                      <td id="total"><b>Rp. -, </b></td>
                    </tr>
                </table>
                <p class="text-success">Metode pembayaran yaitu dengan transfer !</p>
                </div>
              </div>

              <br>
    <p>
      <form  method="post" action="{{route('keranjang.store')}}">
        @csrf
        <input type="hidden" name="nama" id="nama-post" @guest value="" @else value="{{ Auth::user()->name }}" @endif >
        <input type="hidden" name="nohp" id="nohp-post" @guest value="" @else value="{{ Auth::user()->phone }}" @endif >
        <input type="hidden" name="alamat" id="alamat-post">
        <input type="hidden" name="service" id="service-post">
        <input type="hidden" name="total" id="total-post" value="">
        <input type="hidden" name="kurir" id="kurir-post" value="">
        <input type="hidden" name="ongkir" id="ongkir-post" value="">
        <input type="hidden" name="kabupaten" id="kabupaten-post" value="">
      <button class="btn btn-outline-success btn-md float-right" type="submit"><i class="nav-icon fas fa-money-check" ></i> Checkout</button>
      </form>
      </p>
      @guest
     <p class="text-muted">Login untuk checkout !</p>
     @endif
  </div>
</div>
@endif
</div>

@section('js')
 <!-- <script src="{{asset('js/googleapis.ajax.jquery.js')}}"></script> -->
<script src="{{ asset('adminlte/plugins/toastr/toastr.min.js') }}"></script>
       <script type="text/javascript">
         function toastgagal(key, value) 
          {
            toastr.error(key +': '+ value)
          }
       </script>
<script type="text/javascript">
function nama() {
  var nama = document.getElementById("nama-send").value;
  $('#nama-post').val(nama);
  // console.log($('#nama').val());
}

function nohp() {
  var nohp = document.getElementById("nohp-send").value;
  $('#nohp-post').val(nohp);
}

function alamat() {
  var alamat = document.getElementById("alamat-send").value;
  $('#alamat-post').val(alamat);
}

function rupiah(angka){
   var reverse = angka.toString().split('').reverse().join(''),
   ribuan = reverse.match(/\d{1,3}/g);
   ribuan = ribuan.join('.').split('').reverse().join('');
   return ribuan;
 }
 data_paket= [] ;
 subtotal = {{$total}};
 ongkir = 0;
 total= 0;
 kurir_service = '';
//cek ongkir
  $('#cek-ongkir').submit(function(e){
    e.preventDefault();
    $("#loading").show();
    var divIdHtml = $("#myDiv").html();
    var request = new FormData(this);
    var endpoint = "{{route('cek-ongkir')}}";
    $.ajax({
      url: endpoint,
      method: "POST",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')          
      },
      data: request,
      beforeSend: function(){
        $(".loader").css("display","block");
      },
      contentType: false,
      cache: false,
      processData: false,
      // dataType: "json",
      success: function(data) {
        // console.log(data);
        bersih();
        jQuery.each(data, function(i, val) {
          // console.log(i);
          $('#paket').append('<div class="card box-shadow"><div class="card-body"><div class="form-check"><input class="form-check-input" type="radio" onchange="code_kurir(this)" name="paket"  value="'+val.cost[0].value+'"><label class="form-check-label" for="exampleRadios1">Rp. '+rupiah(val.cost[0].value)+' '+val.description+ ' ('+val.service+')</label></div></div></div>');

          data_paket[i] = val; 
        });
        var kurir = $('#kurir').val();
        var kabupaten = $('#kabupaten').val();
        //set form checkout
        $('#kurir-post').val(kurir);
        $('#kabupaten-post').val(kabupaten);
        //end set form checkout
        $(".loader").css("display","none");
      },
      error: function(xhr, status, error) {
                var error = xhr.responseJSON;
        if ($.isEmptyObject(error) == false) {
          $.each(error.errors, function(key, value) {
            toastgagal(key, value);
          });
          $(".loader").css("display","none");
        }
      }
    });
  });
  // end cek ongkir
function code_kurir(service) {
  ongkir = service.value;
  // console.log(subtotal);  
  jQuery.each(data_paket, function(i, val) {
    console.log(val);
    if(val.cost[0].value == ongkir) {
      kurir_service = val.service;
      total = eval(ongkir) + eval(subtotal);
      $('#ongkir').text('Rp. '+rupiah(ongkir)+' '+val.service);
      $('#total').html('<b>Rp. '+rupiah(total)+'</b>');
      $('#service').text(val.description);
      $('#service-post').val(kurir_service);
    }
  });
  // set form checkout
  
  $('#ongkir-post').val(ongkir);
  $('#total-post').val(total);
  // end form checkout 
}


//update jumlah
function updateJumlah(id) {
  $('#update-jumlah-'+id+'').submit(function(e){
    e.preventDefault();
    var ids = eval(document.getElementById('product-id-'+id).value); //id pada inputan
    var request = new FormData(this);
    var endpoint = "update-jumlah/" + ids;
    $.ajax({
      url: endpoint,
      method: "POST",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')          
      },
      data: request,
      beforeSend: function(){
        $(".loader").css("display","block");
      },
      contentType: false,
      cache: false,
      processData: false,
      // dataType: "json",
      success: function(data) {
        bersih();

        $('#berat-form').val(data.berat);
        subtotal = data.subtotal;
        $('#berat').text(data.berat+' Kg');
        $('#matotal').text('Rp. '+ rupiah(data.subtotal));
        $('#matotal1').text('Rp. '+ rupiah(data.subtotal));
        $('#berat-'+id).text(data.data.berat + ' Kg');
        $('#harga-'+id).text('Rp. '+ rupiah(data.data.subtotal) );
        $(".loader").css("display","none");
      },
      error: function(xhr, status, error) {
                var error = xhr.responseJSON;
        if ($.isEmptyObject(error) == false) {
          $.each(error.errors, function(key, value) {
            toastgagal(key, value);
          });
          $(".loader").css("display","none");
        }
      }
    });
  });
}
  // end update jumlah

    // menampilkan kabupaten setelah memilih provinsi
  function show_kabupaten() {
    $("#kabupaten").empty();
    $("#kabupaten").append("<option value=''>--Pilih kabupaten--</option>");
    var id_provinsi = $('#provinsi').val();
    $.ajax({
      'url': "get-all-kabupaten/" + id_provinsi,
      'dataType': 'json',
      beforeSend: function(){
        $(".loader").css("display","block");
      },
      success: function(data) {
        jQuery.each(data, function(i, val) {
          $('#kabupaten').append('<option value="' + val.id + '">' + val.type +' '+ val.city_name + '</option>');
        });
        $(".loader").css("display","none");
      },
      error: function(xhr, status, error) {
                var error = xhr.responseJSON;
        if ($.isEmptyObject(error) == false) {
          $.each(error.errors, function(key, value) {
            toastgagal(key, value);
          });
          $(".loader").css("display","none");
        }
      }
    })
  }
  //end menampilkan kabupaten setelah memilih provinsi


  function bersih()
  {
    ongkir = 0;
    total = 0;
    $('#paket').empty();
    $('#ongkir').text('Rp. -,');
    $('#service').text(' -,');
    $('#total').html('<b>Rp. -,</b>');
  }
</script>
@endsection