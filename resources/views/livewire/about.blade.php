@section('title')
About
@endsection
<style type="text/css">
	@media (min-width: 1200px) {
    .container{
        max-width: 850px;
    }
}
</style>
<div class="container " style="min-height: 28rem !important;">
 
 <!-- membahas FAQ -->
 <h2 class="text-center">About</h2>
 <div id="faq"  style="height: 90px; content: ""; display:fixed;"></div>
 <h4>#FAQ ?</h4>
<div id="accordion">
  <div class="card">
    <div class="card-header bg-white" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link text-muted" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Bagaimana Metode Pembayaran ?
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        metode pembayaran adalah transfer ke rekening penjual, yaitu BRI 5221 8421 5007 0495 an. Khaeruddin Asdar. Perlu di perhatikan agar mempercepat proses pengiriman, pelanggan hendaknya melakukan transfer sesuai dengan nominal pada Total Pembayaran saat Checkout.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header bg-white" id="headingSix">
      <h5 class="mb-0">
        <button class="btn btn-link text-muted" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
          Bagaimana alur transaksi di {{config('app.name')}} ?
        </button>
      </h5>
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
      <h5 class="mb-0">
        <button class="btn btn-link text-muted" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          Apakah harus mengupload bukti pembayaran ?
        </button>
      </h5>
    </div>

    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
      <div class="card-body">
        Sebaiknya Anda mengupload bukti pembayaran, walapun ini berdifat opsional namun hal ini akan berpengaruh terhadap durasi pengecekan kami.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header bg-white" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed text-muted" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Apakah Ada Fitur Cek Ongkir ?
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        Ya, Aplikasi ini memiliki 3 pilihan kurir yaitu JNE, POS Indonesia dan TIKI. Anda dapat melakukan pengecekan biaya ongkir untuk ketiga pilihan kurir tersebut meskipun tanpa login.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header bg-white" id="headingFour">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed text-muted" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Dimana Kota Asal Pengiriman ?
        </button>
      </h5>
    </div>

    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
      <div class="card-body">
        Toko ini berada di Sulawesi Selatan, Kabupten Bone, sehingga pada Cek Ongkir, otomatis akan di hitung dengan kota asal pengiriman yaitu Kabupaten Bone.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header bg-white" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link text-muted collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Bagaimana cara melakukan Cek Ongkir ?
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
      	Anda harus menambahkan produk ke keranjang lalu klik tab keranjang maka akan tampil halaman detail belanjaan Anda dan Anda dapat melakukan Cek Ongkir.
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
 <blockquote class="twitter-tweet"><p lang="in" dir="ltr">Selamat Datang 🙂</p>&mdash; AsdarKoe (@AsdarKH) <a href="https://twitter.com/AsdarKH/status/1264518325612081152?ref_src=twsrc%5Etfw">May 24, 2020</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
 
 <!-- <img src="{{asset('signin.svg')}}"> -->


<!-- End Membahas History -->


<!-- Membahas Location -->
 <div id="location" style="height: 90px"></div>
 <h4>#Location</h4>
 <p class="text-justify">Toko ini berada di Sulawesi Selatan, Kabupaten Bone, sehingga setiap transaksi dan cek ongkos pengiriman memiliki kota asal Kabupaten Bone.</p>
<div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=barebbo&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/en/">google map on web site</a></div><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div>
<!-- End Membahas Location -->

</div>
