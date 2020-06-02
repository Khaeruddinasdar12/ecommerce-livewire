
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>

    <script src="{{asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <link rel="icon" href="{{asset('signin.svg')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    <link href="{{asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" ></script>
    
  </head>
<link rel="stylesheet" type="text/css" href="{{asset('css/font.css')}}">
@yield('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<style type="text/css">
  .loader {
  border: 8px solid #f3f3f3; /* Light grey */
  border-top: 8px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 60px;
  height: 60px;
  z-index: 100;

  position: fixed;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  margin: auto; 
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
@livewireStyles
  <body>

    <livewire:navbar>
<!-- <div id="myDiv">
  <img id="loading" src="{{asset('ajax-loader.gif')}}" style="display:none;"/>
</div> -->

    <div class="container">
      <div class="loader" style="display: none"></div>
      
    @yield('content')

      <footer class="footer pt-4 my-md-5 pt-md-5 border-top text-center">
        <div class="row">
          <div class="col-6 col-md">
            <a href="/features" class="text-dark"><h5>Features</h5></a>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="/features#shopping-cart">Shopping Cart</a></li>
              <li><a class="text-muted" href="/features#history">History</a></li>
              <li><a class="text-muted" href="/features#check-shipping">Check shipping</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <a href="/resources" class="text-dark"><h5>Resources </h5></a>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="/resources#php">Php</a></li>
              <li><a class="text-muted" href="/resources#javascript">Javascript</a></li>
              <li><a class="text-muted" href="/resources#laravel">Laravel</a></li>
              <li><a class="text-muted" href="/resources#turbolinks">Turbolinks</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <a href="/about" class="text-dark"><h5>About</h5></a>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="/about#faq">FAQ ?</a></li>
              <li><a class="text-muted" href="/about#owner-writer">Owner-Writer</a></li>
              <li><a class="text-muted" href="/about#location">Location</a></li>
            </ul>
          </div>
        </div>
      </footer>
      <div class="footer-copyright text-center py-3">© 2020 Copyright: Khaeruddin Asdar
        <a href="#"> ecommerce.adepituedp.or.id</a>
      </div>
    </div>
       <script src="{{asset('bootstrap/assets/js/vendor/popper.min.js') }}"></script>

    @livewireScripts
    @yield('js')
  </body>
</html>
