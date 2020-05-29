<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('categories')->insert([
	        'nama' => 'T-shirt'
		]);

		DB::table('categories')->insert([
	        'nama' => 'Jaket'
		]);

		DB::table('categories')->insert([
	        'nama' => 'Sepatu'
		]);

		DB::table('categories')->insert([
	        'nama' => 'Jeans'
		]);
    }
}
