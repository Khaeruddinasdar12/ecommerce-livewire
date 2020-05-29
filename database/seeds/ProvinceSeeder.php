<?php

use Illuminate\Database\Seeder;
use App\Province;
use Illuminate\Support\Facades\Http;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::withHeaders([
            'key' => '2105cbed601c9bdfcc34806af8369575'
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinces = $response['rajaongkir']['results'];

        foreach($provinces as $province) {
        	$data_province[] = [
        		'id' => $province['province_id'],
        		'nama' => $province['province']
        	];
        }
        Province::insert($data_province);
    }
}
