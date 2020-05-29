@extends('layouts.template')

@section('title')
Manage Admin
@endsection

@section('content')
<div class="container">
<section class="content-header">
  <div class="row">
          <div class="col-5">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tambah Admin</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form" action="" method="POST" id="add-admin">
                  @csrf
                  <div class="form-group">
                    <label for="tipebus">Nama</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="nama">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="tipebus">Email</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="tipebus">Password</label>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control" name="password" id="pw">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="tipebus">Konfirmasi Password</label>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control" name="password_confirmation" id="pw1">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="tipebus">No HP</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="phone" id="phone">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="tipebus">Alamat</label>
                    <div class="input-group mb-3">
                      <textarea class="form-control" rows="2" name="alamat"></textarea>
                    </div>
                  </div>
                   <div class="form-group" style="margin-top: 45px;">
                      <button type="reset" class="btn btn-secondary float-left"><i class="nav-icon fas fa-sync-alt"></i> Reset</button>
                      <button type="submit" class="btn btn-primary float-right"><i class="nav-icon fas fa-save"></i> Tambah</button>
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
                <h3 class="card-title">Data Admin ({{$count}})</h3>

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
                      <th>Nama</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $datas)
                    <tr>
                      <td>{{ $datas->name }}</td>
                      <td>
                            <button class="btn btn-outline-success btn-sm" title="Belum berfungsi" onclick="feature()"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-outline-danger btn-sm" title="Belum berfungsi" onclick="feature()" ><i class="fas fa-trash"></i></button>
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
@endsection

@section('js')
<script>
  //add admin
   $('#add-admin').submit(function(e) {
    e.preventDefault();
    pw = document.getElementById("pw").value;
    pw1 = document.getElementById("pw1").value;
    if(pw != pw1) {
      return toastgagal('Password', 'Konfirmasi password tidak sama');
    }
    
    var request = new FormData(this);
    var endpoint = '{{route("admin.store-admin")}}';
    $.ajax({
      url: endpoint,
      method: "POST",
      data: request,
      contentType: false,
      cache: false,
      processData: false,
      // dataType: "json",
      success: function(data) {
        $('#add-admin')[0].reset();
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
  // end add admin

// fitur hapus dan edit admin belum berfungsi
function feature() {
      Swal.fire({
        type: 'warning',
        title: 'Fitur ini belum berfungsi dan tahap pengembangan',
        showConfirmButton: true,
        button: "Ok"
      })
    }
// end fitur hapus dan edit admin belum berfungsi
</script>

@endsection