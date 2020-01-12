<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use  WebDevEtc\BlogEtc\Models\BlogEtcPost;
use  WebDevEtc\BlogEtc\Models\BlogEtcComment;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except([
            'getAll','getAllPaginate','filterData',
            'showPost','showPostComments','postCommented',
            'filterDataComment'
        ]);
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
        $allData->whereHas('categories',function ($query) use ($cat) {
            $query
                ->where('category_name','like','%'.$cat.'%')
                ->orWhere('slug','like','%'.$cat.'%');
        });
        if (!is_null($search) && !empty($search)) {
            $allData
                ->where('title','like','%'.$search.'%')
                ->orWhere('slug','like','%'.$search.'%')
                ->orWhere('subtitle','like','%'.$search.'%')
                ->orWhere('seo_title','like','%'.$search.'%');
        }
        return $allData->orderBy('posted_at','DESC')->paginate($request->sort);
    }

    public function showPost(Request $request, $slug='')
    {        
        $post = BlogEtcPost::where('slug',$slug)->with('author.person','categories')->get();
        if ($post!='[]') {
            return $request->ajax()?$post:view('web.publicacion',compact('post',$post));
        }
        abort(404, 'Pagina no Encontrada.');
    }

    public function showPostComments(Request $request, $slug)
    {
        $data = $this->filterDataComment($request,$slug);
        return [
            'pagination' => [
                'total'         => $data->total(),
                'current_page'  => $data->currentPage(),
                'per_page'      => $data->perPage(),
                'last_page'     => $data->lastPage(),
                'from'          => $data->firstItem(),
                'to'            => $data->lastItem(),
            ],
            'table' => $data->take($data->perPage())
        ];
    }

    public function filterDataComment($request,$slug)
    {
        $post = BlogEtcPost::where('slug',$slug)
            ->first();
        $comments = BlogEtcComment::with('user.person')
            ->where('blog_etc_post_id',$post->id)
            ->where('approved','1');
        return $comments->orderBy('created_at','DESC')->paginate($request->sort);
    }

    public function postCommented(Request $request, $slug)
    {
        $post = BlogEtcPost::where('slug',$slug)->first();

        if ($id=$request->comentario['user_id']>0) {
            $user = User::findOrFail($id);
            $author = $user->person->firstname.' '.$user->person->firstlastname;
            $post->comments()->create([
                'comment'           =>  $request->comentario['comment'],
                'user_id'           =>  $user->id,
                'author_name'       =>  $author,
                'author_email'      =>  $user->email,
            ]);
        }else{
            $post->comments()->create([
                'comment'           =>  $request->comentario['comment'],
                'author_name'       =>  $request->comentario['name'],
                'author_email'      =>  $request->comentario['email'],
                'author_website'    =>  $request->comentario['web'],
            ]);
        }

    }
}
