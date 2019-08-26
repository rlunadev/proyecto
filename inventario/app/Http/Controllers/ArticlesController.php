<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Tag;
use App\Article;
use App\Image;
use App\User;
Use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller
{
    //
    public function index(Request $request) {
        
    	return redirect()->route('admin.articles.index');
    }

    public function store(ArticleRequest $request) {

    	if ($request->file('image')) {
    		$file = $request->file('image');
    		$name = 'imagen_'.time().'.'.$file->getClientOriginalExtension();
    		$path = public_path().'/images/articles/';
    		$file->move($path,$name);
    	}
        else {}
    	$article=new Article($request->all());
    	$article->user_id = \Auth::user()->id;
    	$article->save();

    	$article->tags()->sync($request->tags);

    	$image = new Image();
    	$image->name=$name;
    	$image->article()->associate($article);
    	$image->save();
    	//dd($article);
    	return redirect()->route('admin.articles.index');
    }

    public function create() {
    	$categories=Category::orderBy('name','ASC')->lists('name','id');
    	$tags=Tag::orderBy('name','ASC')->lists('name','id');
    	return view('admin.articles.create')
    	->with('categories',$categories)
    	->with('tags',$tags);
    }

    public function edit($id) {
       
        $articles=Article::find($id);
        $articles->category;
        $categories=Category::orderBy('name','DESC')->lists('name','id');
        $tags=Tag::orderBy('name','DESC')->lists('name','id');
        $my_tags=$articles->tags->lists('id')->ToArray();
        return view('admin.articles.edit')
        ->with('categories',$categories)
        ->with('articles',$articles)
        ->with('tags',$tags)
        ->with('my_tags',$my_tags);
    }

    public function update(Request $request,$id) {
        $article=Article::find($id);
        $article->fill($request->all());
        $article->save();
        $article->tags()->sync($request->tags);
        //dd($article);
        //Flash::warning('Articulo '.$articles->title.'Editado');
       return redirect()->route('admin.articles.index');
    }

    public function destroy($id) {
        $article=Article::find($id);
        $article->delete();
        return redirect()->route('admin.articles.index');
    }

    public function show($id) {
    	
    }

    public function get () {
        $article=Article::all();
        json_encode($article);
        return $article;
    }
}
