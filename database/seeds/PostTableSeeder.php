<?php

use Illuminate\Database\Seeder;
use WebDevEtc\BlogEtc\Models\BlogEtcCategory;

class PostTableSeeder extends Seeder
{
    public function run()
    {
        // Categorias
        BlogEtcCategory::create([
        	'category_name'			=>	'noticias',
        	'slug'					=>	'noticias-mas-relevantes',
        	'category_description'	=>	'n/a'
        ]);

        BlogEtcCategory::create([
        	'category_name'			=>	'eventos',
        	'slug'					=>	'eventos-proximos',
        	'category_description'	=>	'n/a'
        ]);

        BlogEtcCategory::create([
            'category_name'         =>  'servicios',
            'slug'                  =>  'servicios-ofrecidos',
            'category_description'  =>  'n/a'
        ]);

        BlogEtcCategory::create([
            'category_name'         =>  'convenios',
            'slug'                  =>  'convenios-logrados',
            'category_description'  =>  'n/a'
        ]);

        BlogEtcCategory::create([
            'category_name'         =>  'carrusel',
            'slug'                  =>  'publicaciones-mas-relevantes',
            'category_description'  =>  'n/a'
        ]);
    }
}
