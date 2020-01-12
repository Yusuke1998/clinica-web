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
    	$post = BlogEtcPost::select('title','slug','posted_at','short_description','image_large','image_medium','image_thumbnail');
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

    public function getAllPaginate(Request $request,$cat)
    {
        $data = $this->filterData($request,$cat);
        return [
            'pagination' => [
                'total'         => $data->total(),
                'current_page'  => $data->currentPage(),
                'per_page'      => $data->perPage(),
                'last_page'     => $data->lastPage(),
                'from'          => $data->firstItem(),
                'to'            => $data->lastItem(),
            ],
            'table' => $data
        ];
    }

    public function filterData($request,$cat)
    {
        $search = mb_strtolower($request->search,'UTF-8');
        $allData = BlogEtcPost::with('categories','author.person');

        if (!is_null($search) && !empty($search)) {
            $allData
                ->whereHas('categories',function ($query) use ($cat) {
                    $query
                        ->where('category_name','like','%'.$search.'%')
                        ->orWhere('slug','like','%'.$search.'%');
                })
                ->orWhere('title','like','%'.$search.'%')
                ->orWhere('slug','like','%'.$search.'%')
                ->orWhere('subtitle','like','%'.$search.'%')
                ->orWhere('seo_title','like','%'.$search.'%');
        }
        return $allData->orderBy('posted_at','DESC')->paginate($request->sort);
    }
}
