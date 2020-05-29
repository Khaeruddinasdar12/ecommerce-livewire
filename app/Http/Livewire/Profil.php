<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use App\Province;
use App\City;
use DB;
class Profil extends Component
{
	public $email;
	public $name;
	public $phone;
	public $alamat;

	public function mount()
	{
		$this->email = \Auth::user()->email;
		$this->name = \Auth::user()->name;
		$this->phone = \Auth::user()->phone;
		$this->alamat = \Auth::user()->alamat;
	}
    public function render()
    {
    	$provinsi = Province::select('id', 'nama')->get();
    	$id_alamat = \Auth::user()->id_alamat;
    	
    	if(\Auth::user()->id_alamat == '') {
    	    $city = [];
    	    $id_prov = null;
    	    $id_kab = null;
    	} else {
    	    $lokasi = DB::table('cities')
    					->join('provinces', 'cities.province_id', '=', 'provinces.id')
    					->select('provinces.id as prov_id', 'cities.id as kab_id')
    					->where('cities.id', $id_alamat)
    					->first();
    	$id_prov 	= $lokasi->prov_id; // id porivinsi
    	$id_kab 	= $lokasi->kab_id; // id kabupaten

    	$city = City::where('province_id', $id_prov)
    				->select('id', 'type', 'city_name')
    				->get();
    	}
    	
    	
        return view('livewire.profil', [
        	'provinsi' => $provinsi,  // semua provinsi
        	'id_prov' => $id_prov,
        	'kabupaten' => $city, // data kabupaten berdasarkan id provinsi
        	'id_kab' => $id_kab

        ]);
    }

}
