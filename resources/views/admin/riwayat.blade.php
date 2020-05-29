@extends('layouts.template')

@section('title')
Riwayat Transaksi - Manage
@endsection

@section('content')
<div class="container">
<section class="content-header">
  <!-- <br> -->
  <br>
  <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Riwayat Transaksi</h3>

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
              <div class="card-body table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">No. Transaksi</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Kurir</th>
                      <th scope="col">Status</th>
                      <th scope="col">Total</th>
                      <th scope="col">Bukti</th>
                      <th scope="col">Action</th>
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
                      <td>@if($datas->bukti == '')<img src="{{asset('profil.webp')}}" height="70px" width="70px">@else <img src="{{asset('storage/'.$datas->bukti)}}" height="70px" width="70px"> @endif</td>
                      <td><a href="{{route('admin.detail-transaksi', ['id' => $datas->id])}}"><button class="btn btn-outline-info btn-sm" ><i class="right fas fa-eye" ></i></button></a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <!-- /.card-body -->
            </div>
            {{$data->links()}}
            <!-- /.card -->
          </div>
        </div>
      </section>
</div>
@endsection