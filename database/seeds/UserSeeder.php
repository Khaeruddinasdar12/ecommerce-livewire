<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user[] = [
        		'name' => 'Khaeruddin Asdar',
        		'email' => 'khaeruddinasdar12@gmail.com',
        		'password' => bcrypt('12345678'),
        		'is_admin' => 1,
                'id_alamat' => 87, //id kabupaten bone
        		'alamat' => 'Bone',
        		'phone' => '08234494950x'
        	];
        User::insert($user);
    }
}
