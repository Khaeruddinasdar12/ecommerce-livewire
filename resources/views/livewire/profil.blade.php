@section('title')
Profil {{Auth::user()->name}}
@endsection


<div class="container" style="min-height: 28rem !important">
	<!-- <form wire:submit.prevent="submit">
		<input type="text" wire:model="nama">
		<button type="submit">Submit</button>
	</form> -->
    <h2>My Profile</h2>
    <br>
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
    <form action="{{route('profil')}}" method="post">
    	@csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" placeholder="{{$email}}" disabled>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Nama</label>
      <input type="text" class="form-control" value="{{$name}}" name="name">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">No Hp</label>
    <input type="text" class="form-control" name="phone" value="{{$phone}}">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Provinsi</label>
      <select name="" class="form-control " id="provinsi" onchange="show_kabupaten()">
    	@foreach($provinsi as $prov)
    	<option value="{{$prov->id}}" @if($prov->id == $id_prov) selected @endif>{{$prov->nama}}</option>
    	@endforeach
    </select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputCity">Kabupaten</label>
      <select class="form-control" id="kabupaten" name="id_alamat">
      	@foreach($kabupaten as $kab)
	  	<option value="{{$kab->id}}" @if($kab->id == $id_kab) selected @endif>{{$kab->type .' '.$kab->city_name}}</option>
	  	@endforeach
	  </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Alamat Lengkap</label>
    <textarea class="form-control" name="alamat">{{$alamat}}</textarea>
  </div>
  <button type="submit" class="btn btn-outline-primary btn-sm float-right"><i class="nav-icon fas fa-save"></i> Ubah</button>
</form>
</div>

<style type="text/css">
	@media (min-width: 1200px) {
    .container{
        max-width: 850px;
    }
}
</style>

@section('js')
<script type="text/javascript">

  function show_kabupaten() {
    $("#kabupaten").empty();
    $("#kabupaten").append("<option value=''>Pilih kabupaten/kota</option>");
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
</script>
@endsection
