<?php

use Illuminate\Database\Seeder;
use App\Configuration;

class ConfigurationTableSeeder extends Seeder
{
    public function run()
    {
        Configuration::create([
        	'name'		=>	'clinicliu',
        	'address'	=>	'San Juan de los Morros.',
        	'phone'		=>	'02460400440',
        	'rif'		=>	'j1938918191'
        ]);
    }
}
