<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Informasi Aplikasi
Aplikasi ini adalah aplikasi ecommerce sederhana menggunakan laravel7(php7), database MySQL. aplikasi ini sudah cukup stabil dan 70% SPA untuk user dan untuk admin masih menggunakan sistem biasa. setiap transaksi akan memiliki kota asal kabupaten Bone, Sulawesi Selatan, ini bisa di ganti.
* Kelebihan
    + 70% SPA, sehingga jarang terlihat reload browser saat proses
    + memiliki keranjang belanja
    + bisa CEK Ongkir
    + memiliki auto cancel/pesanan akan otomatis di cancel oleh sistem jika tidak melakukan pembayaran (hanya dihostingan-cron job)
    + generate pdf pada invoice/tagihan (stabil di hostingan)
* Kekurangan
    + Belum memiliki fitur laporan pada admin
    + membutuhkan resource yang banyak
    + metode pembayaran hanya transfer manual

Aplikasi ini dibuat oleh Khaeruddin Asdar dan bersifat open source, source code bisa dilihat <a href="https://github.com/Khaeruddinasdar12/ecommerce-livewire">disini</a>

## Instalasi (Localhost)
Kebutuhan 
* Xampp
* Composer

1. Download Aplikasi ini 
2. Akses foldernya di cmd atau terminal lalu ketikkan(koneksi internet) <blockquote>composer install</blockquote> 
3. ubah nama file <blockquote>.env.example</blockquote> Menjadi <blockquote>.env</blockquote>
4. buat database di phpmyadmin, lalu buka file .env pada no. 3
5. ubah <blockquote>
    DB_DATABASE=laravel<br>
    DB_USERNAME=root<br>
    DB_PASSWORD=
    </blockquote>
    menjadi
    <blockquote>
    DB_DATABASE=nama_db_anda<br>
    DB_USERNAME=nama_user_anda<br>
    DB_PASSWORD=password_anda
    </blockquote>
6. selanjutnya Anda harus menggenerate api_key dari <a href="https://rajaongkir.com/">rajaongkir.com</a> (silakan cari caranya di om google)
7. setelah melakukan point no. 6 ubah kembali file .env anda <blockquote>
    RAJA_ONGKIR_KEY=
    </blockquote>
    menjadi
    <blockquote>
    RAJA_ONGKIR_KEY=api_key_raja_ongkir(hasil_generate)
    </blockquote>
8. lalu di cmd, masih mengakses folder project ketikkan perintah ```php artisan migrate:refresh --seed```
9. kemudian ketikkan perintah ```php artisan serve```
10. buka browser lalu akses ```localhost:8000```
11. Anda akan secara otomatis memiliki akun yang bisa digunakan untuk login yaitu <blockquote>
    email : khaeruddinasdar12@gmail.com<br>
    password : 12345678
    </blockquote>
12. Done.

