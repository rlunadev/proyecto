<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Article;
use Carbon\Carbon;
use App\Category;
use App\Tag;

class FrontController extends Controller
{
    //
	public function __construct() {
		Carbon::setLocale('es');
       
	}
 
    public function index() {

    	// $articles=Article::orderBy('id','DESC')->paginate(12);
    	// $articles->each(function($articles){
    	// 	$articles->category;
    	// 	$articles->image;
    	// });

    	return redirect()->route('admin.articles.index');
        
    	//->with('articles',$articles);
    }

    public function searchCategory($name) {
        $category = Category::SearchCategory($name)->first();
        $articles = $category->articles()->paginate(10);
        $articles->each(function($articles){
            $articles->category;
            $articles->image;
        });
       // dd($articles);
        return view('front.index')
        ->with('articles',$articles);
    }
    public function searchTag($name) {
        $tag=TAG::SearchTag($name)->first();
        $articles = $tag->articles()->paginate(10);
        $articles->each(function($articles){
            $articles->category;
            $articles->image;
        });
         return view('front.index')
        ->with('articles',$articles);
    }
    public function viewArticle($slug) {
        $article = Article::findBySlugOrFail($slug);
        $article->each(function($article){
            $article->category;
            $article->user;
            $article->tags;
            $article->image;
            });
       // dd($article);
        
        return view('front.article')
        ->with('article',$article);
    }
}
