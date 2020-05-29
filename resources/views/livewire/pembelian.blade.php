@section('title')
Daftar Pembelian
@endsection
<div class="container" style="min-height: 28rem !important">
	<div wire:loading class="loader" style="display: none" ></div>
	<h2 class="text-center">Daftar Riwayat Pembelian</h2>
	<br>
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
    @elseif(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session('success') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
  <div class="table-responsive">
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No. Transaksi</th>
      <th scope="col">Nama Penerima</th>
      <th scope="col">Kurir</th>
      <th scope="col">Status</th>
      <th scope="col">Total</th>
      <th scope="col">Bukti</th>
      <th scope="col">Action <span class="text-danger">(sensitif)</span></th>
    </tr>
  </thead>
  <tbody>
  	@foreach($data as $datas)
    <tr>
      <th scope="row"># {{$datas->id}}</th>
      <td>{{$datas->nama}}</td>
      <td><span class="badge badge-dark"> &nbsp; {{$datas->kurir}} &nbsp; </span></td>
      <td>@if($datas->status == 1 || $datas->bukti != '') <span class="badge badge-success"> On progress ! </span>@elseif($datas->status == 0) <span class=" badge badge-danger"> Belum lunas ! </span> @else <span class="badge badge-success"><i class="nav-icon fas fa-check"></i> Selesai ! </span> @endif</td>
      <td>Rp. {{format_uang($datas->total + $datas->id)}}</td>
      <td><button @if($datas->status != 2) class="btn btn-outline-danger btn-sm" @else class="btn btn-outline-success btn-sm" disabled @endif data-toggle="modal" data-target="#upload" data-id="{{$datas->id}}" data-gambar="{{asset('storage/'.$datas->bukti)}}">@if($datas->bukti == '')Upload Bukti @else <img src="{{asset('storage/'.$datas->bukti)}}" class="img-thumbnail" width="70" height="70">  @endif</button></td>
      <td><a href="{{route('detail-pembelian', ['id' => $datas->id])}}"><button class="btn btn-outline-info btn-sm"><i class="right fas fa-eye" ></i></button></a>
      	<button class="btn btn-outline-danger btn-sm" wire:click="hapus({{$datas->id}})"
      		onclick="confirm('Hapus ? Tidak dapat mengembalikan data !') || event.stopImmediatePropagation()"><i class="right fas fa-trash"></i></button></td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
{{$data->links()}}
<!-- Modal -->
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="post" action="{{route('upload')}}" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        <!-- <input type="hidden" name="_method" value="PUT"> -->
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" id="upload-id" name="id">
        <label for="exampleFormControlFile1">Gambar</label>
            <div class="form-group">
              <img id="preview" src="" alt="" width="280">
            </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Gambar (max 3MB)</label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" onchange="tampilkanPreview(this,'preview')" accept="image/*" name="gambar">
              <small>jpeg, jpg, png</small>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"><i class="right fas fa-times" ></i> Tutup</button>
        <button type="submit" class="btn btn-outline-primary btn-sm"><i class="right fas fa-save" ></i> Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>


<script type="text/javascript">
  function tampilkanPreview(gambar,idpreview){
//                membuat objek gambar
var gb = gambar.files;
//                loop untuk merender gambar
for (var i = 0; i < gb.length; i++){
//                    bikin variabel
var gbPreview = gb[i];
var imageType = /image.*/;
var preview=document.getElementById(idpreview);
var reader = new FileReader();
if (gbPreview.type.match(imageType)) {
//                        jika tipe data sesuai
preview.file = gbPreview;
reader.onload = (function(element) {
  return function(e) {
    element.src = e.target.result;
  };
})(preview);
    //                    membaca data URL gambar
    reader.readAsDataURL(gbPreview);
  }else{
//                        jika tipe data tidak sesuai
alert("Type file tidak sesuai. Khusus image.");
}
}
}
</script>

@section('js')
<script type="text/javascript">
$('#upload').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var gambar = button.data('gambar') 
  var id = button.data('id') 
  var modal = $(this)

  modal.find('.modal-body #upload-id').val(id)
  modal.find('.modal-body #preview').attr('src', gambar)
  // modal.find('.modal-body input').val(recipient)
})
</script>
@endsection
