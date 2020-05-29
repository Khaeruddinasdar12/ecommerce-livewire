<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(ProductSeeder::class); // untuk test menambahkan 100 produk
        $this->call(UserSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(KurirSeeder::class);
        
    }
}
