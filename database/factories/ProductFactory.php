<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'nama' => $faker->word(),
        'gambar'=> $faker->word(),
        'stok' => 3,
        'berat' => 1,
        'detail' => $faker->sentence(10),
        'id_admin' => 3,
        'harga' => $faker->numberBetween(100000, 500000),
        'id_category' => $faker->numberBetween(1, 4),
    ];
});
