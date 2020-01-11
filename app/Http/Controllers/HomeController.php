<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  WebDevEtc\BlogEtc\Models\BlogEtcPost;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['getAll']);
    }

    public function getAll($filtro='',$num = 5)
    {
    	$post = BlogEtcPost::select('title','slug','posted_at','short_description');
        if (!is_null($filtro) && !empty($filtro)) {
    		$search = strtolower($filtro);
            $post
	            ->where('title','like','%'.$search.'%')
	            ->orWhere('subtitle','like','%'.$search.'%')
	            ->orWhere('seo_title','like','%'.$search.'%')
	            ->orWhereHas('categories',function ($query) use ($search) {
	                $query
	                	->where('category_name','like','%'.$search.'%')
	                	->orWhere('slug','like','%'.$search.'%');
            });
        }
        return $post
            ->orderBy('posted_at','DESC')
    		->where('is_published','=','1')
    		->take($num)
    		->get();
    }
}
