<?php

use Illuminate\Database\Seeder;
use WebDevEtc\BlogEtc\Models\BlogEtcCategory;

class PostTableSeeder extends Seeder
{
    public function run()
    {
        BlogEtcCategory::create([
        	'category_name'			=>	'Noticias',
        	'slug'					=>	'noticias-mas-relevantes',
        	'category_description'	=>	'n/a'
        ]);

        BlogEtcCategory::create([
        	'category_name'			=>	'Eventos',
        	'slug'					=>	'eventos-proximos',
        	'category_description'	=>	'n/a'
        ]);
    }
}
