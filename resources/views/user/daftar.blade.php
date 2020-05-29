@extends('layouts.usertemplate')
@section('title')
@endsection

@section('content')
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form" action="" method="POST" id="add-admin">
                  <input type="hidden" name="_token" value="PEadwK9xzlUm7nZ3t90qmB359ODpCRgqjAiXaH14">                  <div class="form-group">
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
@endsection