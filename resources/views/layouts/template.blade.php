<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet"> -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>
          
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" data-toggle="modal" data-target="#modal-edit-profile">
              <i class="right fas fa-user"></i> Ubah Profil
            </a>

            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              <i class="right fas fa-sign-out-alt"></i> {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">TicketBus</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image image-s">
            <i class="fa fa-user-circle"></i>
          </div>
          <div class="info">
            <a data-toggle="modal" data-target="#modal-edit-profile" class="d-block">{{ Auth::user()->name }} </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item {{ request()->is('admin') ? 'menu-open' : '' }}">
              <a href="{{route('admin.dashboard')}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item {{ request()->is('admin/managemen-transaksi') || request()->is('admin/managemen-transaksi/riwayat') ? 'has-treeview menu-open' : '' }}">
              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Mangemen Transaksi
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.index-transaksi')}}" class="nav-link {{ request()->is('admin/managemen-transaksi') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Sedang Transaksi
                    </p>
                  </a>
                  <a href="{{route('admin.riwayat-transaksi')}}" class="nav-link {{ request()->is('admin/managemen-transaksi/riwayat') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Riwayat Transaksi
                    </p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item {{ request()->is('admin/managemen-kategori') ? 'menu-open' : '' }}">
              <a href="{{route('admin.index-kategori')}}" class="nav-link">
                <i class="nav-icon fas fa-tags"></i>
                <p>
                 Managemen Kategori
                </p>
              </a>
            </li>

            <li class="nav-item {{ request()->is('admin/managemen-produk') ? 'menu-open' : '' }}">
              <a href="{{route('admin.index-produk')}}" class="nav-link">
                <i class="nav-icon fas fa-box-open"></i>
                <p>
                 Managemen Produk
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Laporan
                </p>
              </a>
            </li>

            <li class="nav-item {{ request()->is('admin/managemen-admin') ? 'menu-open' : '' }}">
              <a href="{{route('admin.index-admin')}}" class="nav-link">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>
                  Managemen Admin
                </p>
              </a>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->


    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2020 <a href="">{{config('app.name')}}</a>.</strong>
      All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

<!-- modal edit profil -->
<div class="modal fade" id="modal-edit-profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profil </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="edit-form-profile" method="post">
        @csrf
      <input type="hidden" name="_method" value="put">
      <input type="hidden" id="user-id" value="{{ Auth::user()->id }}">
      <div class="modal-body">
        <div class="row">
        <div class="col-6">
          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Lengkap </label>
            <input type="text" class="form-control" name="nama" value="{{ Auth::user()->name }}">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">No HP </label>
            <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Alamat </label>
            <textarea class="form-control" name="alamat" rows="2">{{ Auth::user()->alamat }}</textarea>
        </div>
        
      </div>
      <div class="col-6">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email </label>
            <input type="text" class="form-control" value="{{ Auth::user()->email }}" disabled="">
          </div>
          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Password </label>
            <input type="password" class="form-control" name="password">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Konfirmasi Password </label>
            <input type="password" class="form-control" name="password_confirmation">
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
<!-- end modal edit profil -->
  <!-- jQuery -->
  <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('adminlte/plugins/sparklines/sparkline.js') }}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
  <!-- <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script> -->
  <script src="{{ asset('adminlte/plugins/toastr/toastr.min.js') }}"></script>
  

  @yield('js')
  @if(session('success'))
  <script>
    var pesan = '{{session("success")}}';
    loginSukses();

    function loginSukses() {
      Swal.fire({
        type: 'success',
        title: 'Selamat Datang ' + pesan,
        showConfirmButton: false,
        timer: 2500
      })

    }
  </script>
  @endif
  <script type="text/javascript">
const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: true,
      timer: 5000
    });

  function hapus() {
    $(document).on('click', '#del_data', function() {
      Toast.fire({
        type: 'warning',
        title: 'Yakin ? Anda tidak dapat mengembalikan data yang telah di hapus!',
        showCancelButton: true,
        confirmButtonText: 'Hapus!'
      }).then((result) => {
        if(result.value) {
          var me = $(this),
              url = me.attr('href'),
              token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
              url: url,
              method: "POST",
              data: {
                '_method': 'DELETE',
                '_token': token
              },
              success: function(data) {
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
        }
      })
    });
  }
    //edit form profil
$('#edit-form-profile').submit(function(e) {
    e.preventDefault();
    var id = eval(document.getElementById('user-id').value); //id pada inputan
    console.log(id);
    var request = new FormData(this);
    var endpoint = "edit/profil/" + id;
    $.ajax({
      url: endpoint,
      method: "POST",
      data: request,
      contentType: false,
      cache: false,
      processData: false,
      // dataType: "json",
      success: function(data) {
        $('#edit-form-profile')[0].reset(); //id form
        $('#modal-edit-profile').modal('hide'); //id modal
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
//end edit form profil

    function done(status, pesan) {
      if (status == 'success') {
        Toast.fire({
        type: status,
        title: pesan
      }).then(function() {
          location.reload();
        })
      } else {
        Toast.fire({
        type: status,
        title: pesan,
        button: "Ok"
      })
      }
    }

    function error(key, pesan) {
      Toast.fire({
        type: 'error',
        title: key + ' : ' + pesan
      })
    }

    function toastgagal(key, value) 
    {
      toastr.error(key +': '+ value)
    }

    function berhasil(status, pesan) {
      if (status == 'success') {
        Swal.fire({
          type: status,
          title: pesan,
          showConfirmButton: true,
          button: "Ok"
        }).then(function() {
          location.reload();
        })
      } else {
        Swal.fire({
          type: status,
          title: pesan,
          showConfirmButton: true,
          button: "Ok"
        })
      }
    }

    function gagal(key, pesan) {
      Swal.fire({
        type: 'error',
        title: key + ' : ' + pesan,
        showConfirmButton: true,
        button: "Ok"
      })
    }
  </script>
</body>

<style>
  .image-s i {
    font-size: 30px !important;
    color: #ffff;
  }
</style>

</html>