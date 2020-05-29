@extends('layouts.template')

@section('title')
Manage Produk
@endsection

@section('content')
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
<div class="container">
<section class="content-header">
  <button type="button" class="btn btn-outline-primary" title="Tambah Produk" data-toggle="modal" data-target="#modal-add"><i class="fas fa-plus"></i> Tambah Product</button>
  <!-- <br> -->
  <br>
  <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Produk ({{$count}})</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Harga</th>
                      <th>Stok</th>
                      <th>Kategori</th>
                      <th>Gambar</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($produk as $produks)
                    <tr>
                      <td>{{$produks->nama}}</td>
                      <td>Rp. {{format_uang($produks->harga)}}</td>
                      <td>@if($produks->stok > 0) <span class="badge badge-info">Tersedia</span> @else <span class="badge badge-danger">Stok Habis</span>@endif</td>
                      <td>{{$produks->kategori}}</td>
                      <td><img src="{{asset('storage/'.$produks->gambar)}}" width="90px" height="70px" alt="{{$produks->nama}}"></td>
                      <td><button class="btn btn-outline-info btn-sm" title="Detail" data-toggle="modal" data-target="#modal-detail" data-nama="{{$produks->nama}}" data-harga="Rp. {{format_uang($produks->harga)}}" data-stok="{{$produks->stok}}" data-gambar="{{asset('storage/'.$produks->gambar)}}" data-admin="{{$produks->admin}}" data-berat="{{$produks->berat}}" data-kategori="{{$produks->kategori}}" data-detail="{{$produks->detail}}"><i class=" far fa-eye"></i></button>
                            <button class="btn btn-outline-success btn-sm" title="Ubah"><i class="fas fa-pencil-alt" data-toggle="modal" data-target="#modal-edit" data-nama="{{$produks->nama}}" data-harga="{{$produks->harga}}" data-stok="{{$produks->stok}}" data-gambar="{{asset('storage/'.$produks->gambar)}}" data-berat="{{$produks->berat}}" data-detail="{{$produks->detail}}" data-id_category="{{$produks->id_category}}" data-id="{{$produks->id}}"></i></button>

                            <button class="btn btn-outline-danger btn-sm" title="Hapus" onclick="hapus()" 
                             id="del_data" href="managemen-produk/{{$produks->id}}"><i class="fas fa-trash"></i></button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </section>
</div>

<!-- modal detail -->
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-7">
              <div class="form-group text-center">
                <img src="" id="detail-gambar" height="260px" width="320px" border="2px">
              </div>
          </div>
          <div class="col-5">
            <table>
              <tr>
                <td><h6><b>Nama</b></h6></td>
                <td><h6> : </h6></td>
                <td id="detail-nama"></td>
              </tr>
              <tr>
                <td><h6><b>Harga</b></h6></td>
                <td><h6> : </h6></td>
                <td id="detail-harga"></td>
              </tr>
              <tr>
                <td><h6><b>Stok</b></h6></td>
                <td><h6> : </h6></td>
                <td id="detail-stok"></td>
              </tr>
              <tr>
                <td><h6><b>Berat</b></h6></td>
                <td><h6> : </h6></td>
                <td id="detail-berat"></td>
              </tr>
              <tr>
                <td><h6><b>Kategori</b></h6></td>
                <td><h6> : </h6></td>
                <td id="detail-kategori"></td>
              </tr>
              <tr>
                <td><h6><b>Admin</b></h6></td>
                <td><h6> : </h6></td>
                <td id="detail-admin"></td>
              </tr>
            </table>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-12">
            <label for="recipient-name" class="col-form-label">Detail : </label>
            <div class="form-group">
                <p id="detail-detail"></p>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal detail -->


<!-- modal add produk -->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="add-produk" method="post">
        @csrf
      <div class="modal-body">
        <div class="row">
        <div class="col-6">
          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Produk </label>
            <input type="text" class="form-control" name="nama" placeholder="cth. komputer">
          </div>
          </div>
        <div class="col-6">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Kategori </label>
            <select class="form-control" name="kategori">
              @foreach($kategori as $kategoris)
                <option value="{{$kategoris->id}}">{{$kategoris->nama}}</option>
              @endforeach
            </select>
          </div>
          
        </div>
        </div>

        <div class="row">
          <div class="col-4">
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Berat Kg</label>
            <input type="text" class="form-control" name="berat" placeholder="cth. 0.5">
          </div>
          </div>
          <div class="col-4">
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Stok </label>
            <input type="number" class="form-control" name="stok">
          </div>
          </div>
          <div class="col-4">
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Harga Rp.</label>
            <input type="text" class="form-control" name="harga">
          </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="exampleFormControlFile1">Gambar (max 3MB)</label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" onchange="tampilkanPreview(this,'preview')" accept="image/*" name="gambar">
              <small>jpeg, jpg, png</small>
            </div>
          </div>
          <div class="col-6">
            <label for="exampleFormControlFile1">Gambar</label>
            <div class="form-group">
              <img id="preview" src="" alt="" width="120px">
            </div>
          </div>
        </div>

            <div class="row">
              <div class="col-12">
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Deskripsi Produk </label>
            <textarea class="form-control" rows="5" name="detail"></textarea>
          </div>
          </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="nav-icon fas fa-times"></i> Batal</button>
        <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> Tambah</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end modal add produk -->

<!-- modal edit produk -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="edit-form" method="post">
        @csrf
        
        <input type="hidden" name="_method" value="PUT">
      <div class="modal-body">
        <input type="hidden" id="produk-id">
        <div class="row">
        <div class="col-6">
          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Produk </label>
            <input type="text" class="form-control" name="nama" id="edit-nama">
          </div>
          </div>
        <div class="col-6">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Kategori </label>
            <select class="form-control" name="kategori" id="edit-kategori">
              @foreach($kategori as $kategoris)
                <option value="{{$kategoris->id}}">{{$kategoris->nama}}</option>
              @endforeach
            </select>
          </div>
          
        </div>
        </div>

        <div class="row">
          <div class="col-4">
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Berat Kg</label>
            <input type="text" class="form-control" name="berat" id="edit-berat">
          </div>
          </div>
          <div class="col-4">
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Stok </label>
            <input type="number" class="form-control" name="stok" id="edit-stok">
          </div>
          </div>
          <div class="col-4">
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Harga Rp.</label>
            <input type="text" class="form-control" name="harga" id="edit-harga">
          </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="exampleFormControlFile1">Gambar (max 3MB)</label>
              <input type="file" class="form-control-file" id="exampleFormControlFile2" onchange="tampilkanPreview(this,'edit-preview')" accept="image/*" name="gambar">
              <small>jpeg, jpg, png</small>
            </div>
          </div>
          <div class="col-6">
            <label for="exampleFormControlFile1">Gambar Anda Sekarang</label>
            <div class="form-group">
              <img id="edit-preview" src="" alt="" width="120px">
            </div>
          </div>
        </div>

            <div class="row">
              <div class="col-12">
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Deskripsi Produk </label>
            <textarea class="form-control" rows="5" name="detail" id="edit-detail"></textarea>
          </div>
          </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="nav-icon fas fa-times"></i> Batal</button>
        <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> Ubah</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end modal edit produk -->
@endsection

@section('js')
<script type="text/javascript">
  // modal detail
  $('#modal-detail').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var gambar = button.data('gambar')
  var harga = button.data('harga')
  var stok = button.data('stok')
  var nama = button.data('nama')
  var berat = button.data('berat')
  var detail = button.data('detail')
  var kategori = button.data('kategori')
  var admin = button.data('admin')
  var detail = button.data('detail')
  var modal = $(this)
  modal.find('.modal-body #detail-harga').html('<h6>'+harga+'</h6>')
  modal.find('.modal-body #detail-kategori').html('<h6>'+kategori+'</h6>')
  modal.find('.modal-body #detail-nama').html('<h6>'+nama+'</h6>')
  modal.find('.modal-body #detail-admin').html('<h6>'+admin+'</h6>')
  modal.find('.modal-body #detail-stok').html('<h6>'+stok+'</h6>')
  modal.find('.modal-body #detail-berat').html('<h6>'+berat+ ' kg</h6>')
  modal.find('.modal-body #detail-detail').text(detail)
  modal.find('.modal-body #detail-gambar').attr('src', gambar)
})
  // end modal detail

  // modal edit
  $('#modal-edit').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var gambar = button.data('gambar')
  var produk_id = button.data('id')
  var harga = button.data('harga')
  var stok = button.data('stok')
  var nama = button.data('nama')
  var berat = button.data('berat')
  var detail = button.data('detail')
  var id_kategori = button.data('id_category')
  var modal = $(this)
  modal.find('.modal-body #produk-id').val(produk_id)
  modal.find('.modal-body #edit-harga').val(harga)
  modal.find('.modal-body #edit-kategori').val(id_kategori)
  modal.find('.modal-body #edit-nama').val(nama)
  modal.find('.modal-body #edit-stok').val(stok)
  modal.find('.modal-body #edit-berat').val(berat)
  modal.find('.modal-body #edit-detail').val(detail)
  modal.find('.modal-body #edit-preview').attr('src', gambar)
})
  // end modal edit

   //add produk
   $('#add-produk').submit(function(e) {
    e.preventDefault();
    var request = new FormData(this);
    var endpoint = '{{route("admin.store-produk")}}';
    $.ajax({
      url: endpoint,
      method: "POST",
      data: request,
      contentType: false,
      cache: false,
      processData: false,
      // dataType: "json",
      success: function(data) {
        $('#add-produk')[0].reset();
        $('#modal-add').hide();
        done(data.status, data.pesan);
      },
      error: function(xhr, status, error) {
        var error = xhr.responseJSON;
        if ($.isEmptyObject(error) == false) {
          $.each(error.errors, function(key, value) {
            toastgagal(key, value);
          });
        }
      }
    });
  });
  // end add produk

  //edit form produk
$('#edit-form').submit(function(e) {
    var nama = document.getElementById("edit-nama").value;
    e.preventDefault();
    if(nama == '') {
      return toastgagal('nama', ' kolom tidak boleh kosong')
    }
    var id = eval(document.getElementById('produk-id').value); //id pada inputan
    console.log(id);
    var request = new FormData(this);
    var endpoint = "managemen-produk/" + id;
    $.ajax({
      url: endpoint,
      method: "POST",
      data: request,
      contentType: false,
      cache: false,
      processData: false,
      // dataType: "json",
      success: function(data) {
        $('#edit-form')[0].reset(); 
        $('#modal-edit').modal('hide');
        done(data.status, data.pesan);
      },
      error: function(xhr, status, error) {
        var error = xhr.responseJSON;
        if ($.isEmptyObject(error) == false) {
          $.each(error.errors, function(key, value) {
            toastgagal(key, value);
          });
        }
      }
    });
  });
//end edit form produk
</script>
@endsection