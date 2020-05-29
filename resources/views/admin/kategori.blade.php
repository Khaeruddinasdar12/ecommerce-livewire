@extends('layouts.template')

@section('title')
Manage Kategori
@endsection

@section('content')
<div class="container">
<section class="content-header">
  <div class="row">
          <div class="col-5">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tambah Kategori</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form" action="" method="POST" id="add-kategori">
                  @csrf
                  <div class="form-group">
                    <label for="tipebus">Nama Kategori</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="nama" id="nama">
                      <span class="input-group-append">
                        <button type="submit" class="btn btn-outline-info"><i class="fas fa-plus"></i> Tambah</button>
                      </span>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-7">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Kategori ({{$count}})</h3>

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
                <table class="table table-hover text-nowrap" id="tabel">
                  <thead>
                    <tr>
                      <th>Nama Kategori</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $datas)
                    <tr>
                      <td>{{ $datas->nama }}</td>
                      <td>
                            <button class="btn btn-outline-success btn-sm" title="Ubah" data-toggle="modal" data-target="#modal-edit" data-nama="{{$datas->nama}}" data-id="{{$datas->id}}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-outline-danger btn-sm" title="Hapus" onclick="hapus()" 
                             id="del_data" href="managemen-kategori/{{$datas->id}}"><i class="fas fa-trash"></i></button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <hr>
                {{ $data->links() }} 
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </section>
</div>


<!-- modal edit -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-form">
          @csrf
          <input type="hidden" id="kategori-id">
          <input type="hidden" name="_method" value="PUT">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Kategori :</label>
            <input type="text" class="form-control" id="edit-nama" name="nama">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="nav-icon fas fa-times"></i> Close</button>
        <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> Ubah</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end modal edit -->
@endsection

@section('js')
<script>
  //Hapus Kategori
//end hapus kategori

//edit form kategori
$('#edit-form').submit(function(e) {
    var nama = document.getElementById("edit-nama").value;
    e.preventDefault();
    if(nama == '') {
      return toastgagal('nama', ' kolom tidak boleh kosong')
    }
    var id = eval(document.getElementById('kategori-id').value); //id pada inputan
    console.log(id);
    var request = new FormData(this);
    var endpoint = "managemen-kategori/" + id;
    $.ajax({
      url: endpoint,
      method: "POST",
      data: request,
      contentType: false,
      cache: false,
      processData: false,
      // dataType: "json",
      success: function(data) {
        $('#edit-form')[0].reset(); //id form
        $('#modal-edit').modal('hide'); //id modal
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
//end edit form kategori

//edit show kategori
  $('#modal-edit').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var nama = button.data('nama')
  var id = button.data('id')
  var modal = $(this)
  modal.find('.modal-body #kategori-id').val(id)
  modal.find('.modal-body #edit-nama').val(nama)
})
  // end edit show kategori


  //add kategori
   $('#add-kategori').submit(function(e) {
    var nama = document.getElementById("nama").value;
    e.preventDefault();
    if(nama == '') {
      return toastgagal('nama', ' kolom tidak boleh kosong')
    }
    
    var request = new FormData(this);
    var endpoint = '{{route("admin.store-kategori")}}';
    $.ajax({
      url: endpoint,
      method: "POST",
      data: request,
      contentType: false,
      cache: false,
      processData: false,
      // dataType: "json",
      success: function(data) {
        $('#add-kategori')[0].reset();
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
  // end add kategori
  

</script>

@endsection