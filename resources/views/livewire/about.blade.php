@section('title')
About
@endsection
<style type="text/css">
.map-responsive{
    overflow:hidden;
    padding-bottom:56.25%;
    position:relative;
    height:0;
}
.map-responsive iframe{
    left:0;
    top:0;
    height:100%;
    width:100%;
    position:absolute;
}
.map-responsive blockquote{
    left:0;
    top:0;
    height:100%;
    width:100%;
    position:absolute;
}
	@media (min-width: 1200px) {
    .container{
        max-width: 850px;
    }
    
    @media (min-width: 576px) {
        .container{
            padding-right: 10px;
            padding-left: 10px;
            margin-right: auto;
            margin-left: auto;
        }
        .map{
            padding-right: 10px;
            padding-left: 10px;
            margin-right: auto;
            margin-left: auto;
        }
    }
}
</style>

<div class="container" style="min-height: 28rem !important;">
 
 <!-- membahas FAQ -->

 <h2 class="text-center">About</h2>
 <div id="faq"  style="height: 90px; content: ""; display:fixed;"></div>
 <h4>#FAQ ?</h4>
 <div class="row">
     <div class="col">
<div id="accordion">
  <div class="card">
    <div class="card-header bg-white" id="headingOne">
        <u>
            <a class="card-link text-muted" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="cursor:pointer">
              Bagaimana Metode Pembayaran ?
            </a>
        </u>
     
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        metode pembayaran adalah transfer ke rekening penjual, yaitu BRI 5221 8421 5007 0495 an. Khaeruddin Asdar. Perlu di perhatikan agar mempercepat proses pengiriman, pelanggan hendaknya melakukan transfer sesuai dengan nominal pada Total Pembayaran saat Checkout.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header bg-white" id="headingSix">
      <u>
        <a class="card-link text-muted" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix" style="cursor:pointer">
          Bagaimana alur transaksi di {{config('app.name')}} ?
        </a>
      </u>
    </div>

    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
      <div class="card-body">
        Anda harus menjadi member untuk melakukan transaksi<br>
        <ul>
          <li>temukan produk yang akan Anda beli</li>
          <li>masukkan ke dalam keranjang </li>
          <li>masukkan detail pengiriman</li>
          <li>tekan tombol checkout</li>
          <li>lakukan pengiriman biaya sesuai dengan Total Pembayaran pada tagihan</li>
          <li>upload bukti pembayaran (opsional), bersifat rekomendasi</li>
          <li>barang Anda segera diproses</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header bg-white" id="headingFive">
      <u>
        <a class="card-link text-muted" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" style="cursor:pointer">
          Apakah harus mengupload bukti pembayaran ?
        </a>
      </u>
    </div>

    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
      <div class="card-body">
        Sebaiknya Anda mengupload bukti pembayaran, walapun ini berdifat opsional namun hal ini akan berpengaruh terhadap durasi pengecekan kami.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header bg-white" id="headingTwo">
      <u>
        <a class="card-link collapsed text-muted" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="cursor:pointer">
          Apakah Ada Fitur Cek Ongkir ?
        </a>
      </u>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        Ya, Aplikasi ini memiliki 3 pilihan kurir yaitu JNE, POS Indonesia dan TIKI. Anda dapat melakukan pengecekan biaya ongkir untuk ketiga pilihan kurir tersebut meskipun tanpa login.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header bg-white" id="headingFour">
      <u>
        <a class="card-link collapsed text-muted" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="cursor:pointer">
          Dimana Kota Asal Pengiriman ?
        </a>
      </u>
    </div>

    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
      <div class="card-body">
        Toko ini berada di Sulawesi Selatan, Kabupten Bone, sehingga pada Cek Ongkir, otomatis akan di hitung dengan kota asal pengiriman yaitu Kabupaten Bone.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header bg-white" id="headingThree">
      <u>
        <a class="card-link text-muted collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="cursor:pointer">
          Bagaimana cara melakukan Cek Ongkir ?
        </a>
      </u>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
      	Anda harus menambahkan produk ke keranjang lalu klik tab keranjang maka akan tampil halaman detail belanjaan Anda dan Anda dapat melakukan Cek Ongkir.
      </div>
    </div>
  </div>
</div>
</div>
</div>
 <!-- End Membahas FAQ -->


 <!-- Membahas Owner-Writer -->
  <div id="owner-writer" style="height: 90px"></div>
 <h4>#Owner-Writer</h4>
 <div class="row">
   <div class="col-4">
 <img src="{{asset('asdar.jpg')}}" class="img-thumbnail" alt="..." width="200" height="200">
   </div>
   <div class="col-8">
      <p class="text-justify">Owner atau pemilik sekaligus pengelolah aplikasi toko online ini bernama Khaeruddin Asdar, Seorang mahasiswa Stmik Dipanegara Makassar semester 6 pada jurusan Teknik Informatika.</p>
   </div>
 </div>
 <div class="row">
 <div class="col-md-12">
 <blockquote class="twitter-tweet"><p lang="in" dir="ltr">Selamat Datang 🙂</p>&mdash; AsdarKoe (@AsdarKH) <a href="https://twitter.com/AsdarKH/status/1264518325612081152?ref_src=twsrc%5Etfw">May 24, 2020</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
 </div>
 </div>
 <!-- <img src="{{asset('signin.svg')}}"> -->


<!-- End Membahas History -->


<!-- Membahas Location -->
 <div id="location" style="height: 90px"></div>
 <h4>#Location</h4>
 <p class="text-justify">Toko ini berada di Sulawesi Selatan, Kabupaten Bone, sehingga setiap transaksi dan cek ongkos pengiriman memiliki kota asal Kabupaten Bone.</p>
 <div class="map-responsive">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15908.260297696235!2d120.33870336889859!3d-4.58233871932145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbde6200a41eee1%3A0xbc65981ca9581679!2sJl.%20Poros%20Pattito%20Bajo%2C%20Talungeng%2C%20Barebbo%2C%20Kabupaten%20Bone%2C%20Sulawesi%20Selatan!5e0!3m2!1sid!2sid!4v1590768948921!5m2!1sid!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
<!-- End Membahas Location -->

</div>
